<?php

namespace App;

use CurlHandle;
use RuntimeException;

class Test
{
    /**
     * Simula jogadores usando as rotas do jogo em paralelo.
     *
     * @return array<int, array<string, mixed>>
     */
    public function execute(
        int $players,
        int $requestsPerMinute = 5,
        int $maxSeconds = 60,
        string $baseUrl = 'http://localhost:8000',
    ): array {
        if ($players < 1 || $requestsPerMinute < 1 || $maxSeconds < 1) {
            throw new RuntimeException(
                'players, requestsPerMinute e maxSeconds devem ser maiores que zero.',
            );
        }

        if (!function_exists('curl_multi_init')) {
            throw new RuntimeException('A extensão cURL não está habilitada no PHP.');
        }

        $states = [];
        for ($index = 0; $index < $players; $index++) {
            $states[$index] = [
                'status' => 'starting',
                'player_id' => null,
                'attribute_id' => null,
                'history' => [],
                'requests' => 0,
                'last_action' => 'start',
                'message' => null,
                'error_key' => null,
            ];
        }

        $multiHandle = curl_multi_init();
        $startedAt = microtime(true);
        $interval = 60 / $requestsPerMinute;

        try {
            $this->dispatchBatch($multiHandle, $states, true, $baseUrl);

            while ($this->hasActivePlayers($states)) {
                $this->waitForBatch($multiHandle, $states);

                if (!$this->hasActivePlayers($states)) {
                    break;
                }

                if (microtime(true) - $startedAt >= $maxSeconds) {
                    $this->stopActivePlayers($states, 'Tempo máximo atingido.');
                    break;
                }

                $waitTime = min(
                    $interval,
                    max(0, $maxSeconds - (microtime(true) - $startedAt)),
                );
                if ($waitTime > 0) {
                    usleep((int) ($waitTime * 1_000_000));
                }

                $this->dispatchBatch($multiHandle, $states, false, $baseUrl);
            }
        } finally {
            curl_multi_close($multiHandle);
        }

        return $states;
    }

    /**
     * @param array<int, array<string, mixed>> $states
     */
    private function dispatchBatch(
        \CurlMultiHandle $multiHandle,
        array &$states,
        bool $startOnly,
        string $baseUrl,
    ): void {
        foreach ($states as $index => &$state) {
            if ($state['status'] !== 'starting' && $state['status'] !== 'active') {
                continue;
            }

            if ($startOnly) {
                $action = 'start';
            } elseif (empty($state['history']) || random_int(1, 5) > 1) {
                $action = 'answer';
            } else {
                $action = 'back';
            }

            $this->addRequest($multiHandle, $index, $state, $action, $baseUrl);
        }
        unset($state);
    }

    /**
     * @param array<string, mixed> $state
     */
    private function addRequest(
        \CurlMultiHandle $multiHandle,
        int $index,
        array &$state,
        string $action,
        string $baseUrl,
    ): void {
        $url = rtrim($baseUrl, '/').'/game';
        $payload = [];

        if ($action === 'answer') {
            $payload = [
                'player_id' => $state['player_id'],
                'attribute_id' => $state['attribute_id'],
                'answer_score' => [0, 0.5, 1, 1.5, 2][random_int(0, 4)],
            ];
        } elseif ($action === 'back') {
            $url .= '/back';
            $payload = [
                'player_id' => $state['player_id'],
                'attribute_id' => $state['history'][array_key_last($state['history'])],
            ];
        }

        $handle = curl_init($url);
        curl_setopt_array($handle, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload, JSON_THROW_ON_ERROR),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT_MS => 2_000,
            CURLOPT_TIMEOUT_MS => 10_000,
            CURLOPT_PRIVATE => json_encode([
                'index' => $index,
                'action' => $action,
            ], JSON_THROW_ON_ERROR),
        ]);

        curl_multi_add_handle($multiHandle, $handle);
        $state['requests']++;
        $state['last_action'] = $action;
    }

    /**
     * @param array<int, array<string, mixed>> $states
     */
    private function waitForBatch(\CurlMultiHandle $multiHandle, array &$states): void
    {
        do {
            $multiStatus = curl_multi_exec($multiHandle, $running);
            if ($multiStatus !== CURLM_OK) {
                throw new RuntimeException(curl_multi_strerror($multiStatus));
            }

            while ($result = curl_multi_info_read($multiHandle)) {
                /** @var CurlHandle $handle */
                $handle = $result['handle'];
                $metadata = json_decode(curl_getinfo($handle, CURLINFO_PRIVATE), true);
                $index = $metadata['index'];
                $state = &$states[$index];
                $body = curl_multi_getcontent($handle);
                $statusCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                $curlError = curl_error($handle);

                if ($curlError !== '' || $statusCode >= 500) {
                    $this->stopPlayer(
                        $state,
                        $statusCode >= 500 ? "HTTP {$statusCode}" : $curlError,
                        $body,
                    );
                } elseif ($statusCode < 200 || $statusCode >= 300) {
                    $this->stopPlayer($state, "HTTP {$statusCode}", $body);
                } else {
                    $this->applyResponse($state, $metadata['action'], $body);
                }

                unset($state);
                curl_multi_remove_handle($multiHandle, $handle);
                curl_close($handle);
            }

            if ($running > 0) {
                $selected = curl_multi_select($multiHandle, 1.0);
                if ($selected === -1) {
                    usleep(1_000);
                }
            }
        } while ($running > 0);
    }

    /**
     * @param array<string, mixed> $state
     */
    private function applyResponse(array &$state, string $action, string $body): void
    {
        $decoded = json_decode($body, true);
        $data = $decoded['data'] ?? null;

        if (!is_array($data) || !isset($data['player'])) {
            $this->stopPlayer($state, 'Resposta inválida', $body);
            return;
        }

        if (!empty($data['possible_character'])) {
            $state['status'] = 'character_found';
            $state['message'] = $data['possible_character'];
            return;
        }

        if ($action === 'answer') {
            $state['history'][] = $state['attribute_id'];
        } elseif ($action === 'back') {
            array_pop($state['history']);
        }

        $state['status'] = 'active';
        $state['player_id'] = $data['player'];
        $state['attribute_id'] = $data['attribute_id'] ?? null;
    }

    /**
     * @param array<string, mixed> $state
     */
    private function stopPlayer(array &$state, string $message, string $body): void
    {
        $decoded = json_decode($body, true);
        $state['status'] = 'error';
        $state['message'] = $message;
        $state['error_key'] = $decoded['error_key'] ?? null;
    }

    /**
     * @param array<int, array<string, mixed>> $states
     */
    private function hasActivePlayers(array $states): bool
    {
        foreach ($states as $state) {
            if (in_array($state['status'], ['starting', 'active'], true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array<int, array<string, mixed>> $states
     */
    private function stopActivePlayers(array &$states, string $message): void
    {
        foreach ($states as &$state) {
            if (in_array($state['status'], ['starting', 'active'], true)) {
                $state['status'] = 'stopped';
                $state['message'] = $message;
            }
        }
        unset($state);
    }
}

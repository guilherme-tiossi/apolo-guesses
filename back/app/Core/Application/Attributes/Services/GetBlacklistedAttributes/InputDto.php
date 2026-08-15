<?php

namespace App\Core\Application\Attributes\Services\GetBlacklistedAttributes;

readonly class InputDto
{
    public function __construct(
        public int $playerId
    ) {
    }
}
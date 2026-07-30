<?php

namespace App\Core\Application\Attributes\Services\GetQuestion;

readonly class OutputDto {
    public function __construct(
        public string $question,
        public int $attributeId,
        public int $playerId
    ) {
    }
}
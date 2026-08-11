<?php

namespace App\Core\Application\Attributes\Services\GetQuestion;

readonly class InputDto {
    public function __construct(
        public ?string $playerId = null
    ) {
    }
}
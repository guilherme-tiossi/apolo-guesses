<?php

namespace App\Core\Application\Attributes\UseCases\GetInitialQuestion;

readonly class InputDto {
    public function __construct(
        public ?string $userId = null
    ) {
    }
}
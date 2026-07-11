<?php

namespace App\Core\Application\Attributes\Factories\QuestionGetterFactory;

readonly class InputDto
{
    public function __construct(
        public ?int $temporaryUserId = null
    ) {
    }
}
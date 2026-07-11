<?php

namespace App\Core\Application\Attributes\UseCases\GetQuestion;

readonly class InputDto
{
    public function __construct(
        public ?int $temporaryUserId = null
    ) {
    }
}
<?php

namespace App\Core\Application\Answers\UseCases\PutAnswer;

readonly class InputDto
{
    public function __construct(
        public int $temporaryUserId,
        public int $attributeId,
        public float $answerScore
    ) {
    }
}
<?php

namespace App\Core\Application\Answers\UseCases\GetAnswers;

readonly class InputDto {
    public function __construct(
        public int $userId
    ) {
    }
}
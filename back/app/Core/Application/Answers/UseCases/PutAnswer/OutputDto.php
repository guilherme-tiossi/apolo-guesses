<?php

namespace App\Core\Application\Answers\UseCases\PutAnswer;

readonly class OutputDto
{
    public function __construct(
        public string $characterName
    ) {
    }
}

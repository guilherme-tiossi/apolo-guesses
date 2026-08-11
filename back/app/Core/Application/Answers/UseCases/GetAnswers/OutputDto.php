<?php

namespace App\Core\Application\Answers\UseCases\GetAnswers;

use App\Core\Domain\Answers\Entities\Answer;

readonly class OutputDto
{
    public function __construct(
        /** @var Answer[] */
        public array $answers
    ) {
    }
}
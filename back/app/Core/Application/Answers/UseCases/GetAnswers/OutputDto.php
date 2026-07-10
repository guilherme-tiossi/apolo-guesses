<?php

namespace App\Core\Application\Answers\UseCases\GetAnswers;

use App\Core\Domain\Answers\Entities\Answer;
use App\Core\Domain\Attributes\Entities\Attribute;


readonly class OutputDto
{
    public function __construct(
        /** @var Answer[] */
        public array $answers
    ) {
    }
}
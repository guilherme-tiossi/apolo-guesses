<?php

namespace App\Core\Application\Characters\Services\CandidateDataGetter;

use App\Core\Domain\Answers\Entities\Answer;

readonly class InputDto
{
    public function __construct(
        public int $playerId,
        /** @var Answer[] */
        public array $answers,
        /** @var int[] */
        public ?array $attributesIn = null
    ) {
    }
}
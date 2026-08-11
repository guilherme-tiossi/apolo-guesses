<?php

namespace App\Core\Application\Characters\Services\CandidateDataGetter;

readonly class OutputDto
{
    public function __construct(
        /** @var CharacterAttributeDto[] */
        public array $candidatesAttributes,
        public int $candidatesCount
    ) {
    }
}
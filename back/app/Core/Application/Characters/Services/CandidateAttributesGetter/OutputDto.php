<?php

namespace App\Core\Application\Characters\Services\CandidateAttributesGetter;

readonly class OutputDto
{
    public function __construct(
        /** @var array[] */ // tipar melhor depois
        public array $candidatesAttributes,
        public int $candidatesCount
    ) {
    }
}
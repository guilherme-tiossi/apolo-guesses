<?php

namespace App\Core\Application\Characters\Services\CandidateDataGetter;

readonly class CandidateAttributeDto
{
    public function __construct(
        public int $characterId,
        public int $attributeId
    ) {
    }
}
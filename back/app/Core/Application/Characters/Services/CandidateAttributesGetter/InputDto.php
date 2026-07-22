<?php

namespace App\Core\Application\Characters\Services\CandidateAttributesGetter;

readonly class InputDto
{
    public function __construct(
        public int $temporaryUserId
    ) {
    }
}
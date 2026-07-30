<?php

namespace App\Core\Application\Game\UseCases\Play;

readonly class InputDto
{
    public function __construct(
        public ?int $playerId = null,
        public ?int $attributeId = null,
        public ?float $answerScore = null
    ) {
    }
}
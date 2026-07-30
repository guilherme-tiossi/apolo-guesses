<?php

namespace App\Core\Application\Game\UseCases\Play;

readonly class OutputDto
{
    public function __construct(
        public int $playerId,
        public ?string $question = null,
        public ?string $characterName = null,
        public ?int $attributeId = null
    ) {
    }
}
<?php

namespace App\Core\Application\Answers\UseCases\UndoAnswer;

readonly class OutputDto
{
    public function __construct(
        public int $playerId,
        public int $attributeId,
        public string $question,
    ) {
    }
}

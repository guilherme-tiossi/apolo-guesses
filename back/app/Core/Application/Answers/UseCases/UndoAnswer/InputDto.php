<?php

namespace App\Core\Application\Answers\UseCases\UndoAnswer;

readonly class InputDto
{
    public function __construct(
        public int $playerId,
        public int $attributeId,
    ) {
    }
}

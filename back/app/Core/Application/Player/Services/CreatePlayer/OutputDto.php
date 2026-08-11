<?php

namespace App\Core\Application\Player\Services\CreatePlayer;

readonly class OutputDto
{
    public function __construct(
        public int $playerId
    ) {
    }
}
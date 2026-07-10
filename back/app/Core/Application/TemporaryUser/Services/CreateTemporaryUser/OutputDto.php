<?php

namespace App\Core\Application\TemporaryUser\Services\CreateTemporaryUser;

readonly class OutputDto
{
    public function __construct(
        public int $userId
    ) {
    }
}
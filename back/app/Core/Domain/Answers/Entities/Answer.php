<?php

namespace App\Core\Domain\Answers\Entities;

use App\Core\Domain\Attributes\Entities\Attribute;

class Answer
{
    public function __construct(
        public string $userId,
        public Attribute $attribute,
        public bool $value
    ) {
    }
}
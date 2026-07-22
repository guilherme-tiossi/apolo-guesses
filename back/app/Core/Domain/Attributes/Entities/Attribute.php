<?php

namespace App\Core\Domain\Attributes\Entities;

use App\Core\Domain\Attributes\Interfaces\Attribute as AttributeEnum;

class Attribute
{
    public function __construct(
        public int $id,
        public string $question,
        public string $portugueseQuestion,
        public ?AttributeEnum $enum    
    ) {
    }
}
<?php

namespace App\Core\Application\Attributes\Services\GetBlacklistedAttributes;

use App\Core\Domain\Attributes\Entities\Attribute;

readonly class OutputDto
{
    public function __construct(
        /** @var Attribute[] */
        public array $attributes
    ) {
    }
}
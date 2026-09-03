<?php

namespace App\Core\Domain\Attributes\Services;

use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Interfaces\Attribute;

class AttributeIgnorancePolicy
{
    private const SHOULD_IGNORE_WHEN_NEGATIVE = [
        InitialAttribute::LIVING_ALIVE->value => [
            InitialAttribute::AGE_ADULT,
            InitialAttribute::AGE_CHILD,
            InitialAttribute::AGE_TEENAGER,
            InitialAttribute::AGE_ELDERLY
        ],
        InitialAttribute::AGE_ADULT->value => [
            InitialAttribute::AGE_ELDERLY
        ],
    ];

    private const SHOULD_IGNORE_WHEN_POSITIVE = [
        InitialAttribute::LIVING_DECEASED->value => [
            InitialAttribute::AGE_ADULT,
            InitialAttribute::AGE_CHILD,
            InitialAttribute::AGE_TEENAGER,
            InitialAttribute::AGE_ELDERLY
        ]
    ];

    public static function shouldIgnore(Attribute $attribute, float $answerScore): array
    {
        if (!empty(self::SHOULD_IGNORE_WHEN_POSITIVE[$attribute->value]) && $answerScore >= 1.25) {
            return self::SHOULD_IGNORE_WHEN_POSITIVE[$attribute->value];
        }

        if (!empty(self::SHOULD_IGNORE_WHEN_NEGATIVE[$attribute->value]) && $answerScore <= 0.75) {
            return self::SHOULD_IGNORE_WHEN_NEGATIVE[$attribute->value];
        }

        return [];
    }
}

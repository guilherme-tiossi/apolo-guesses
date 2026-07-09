<?php

namespace App\Core\Domain\Attributes\Services;

use App\Core\Domain\Attributes\Enums\AttributeSubgroup;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use App\Core\Domain\Attributes\Interfaces\Attribute;

class AttributeOppositionPolicy
{
    private const PAIRS = [
        [InitialAttribute::SKIN_FAIR, InitialAttribute::SKIN_DARK],
        [InitialAttribute::LIVING_ALIVE, InitialAttribute::LIVING_DECEASED],
        [InitialAttribute::GENDER_MALE, InitialAttribute::GENDER_FEMALE],
        [SecondaryAttribute::POLITICAL_CONSERVATIVE, SecondaryAttribute::POLITICAL_PROGRESSIVE],
        [SecondaryAttribute::ALIGNMENT_HEROIC, SecondaryAttribute::ALIGNMENT_VILLAINOUS],
        [InitialAttribute::HAIR_STRAIGHT, SecondaryAttribute::HAIR_WAVY],
        [InitialAttribute::HAIR_STRAIGHT, SecondaryAttribute::HAIR_CURLY],
        [InitialAttribute::HAIR_STRAIGHT, SecondaryAttribute::HAIR_COILY],
        [InitialAttribute::AGE_ADULT, SecondaryAttribute::AGE_CHILD],
        [InitialAttribute::AGE_ADULT, SecondaryAttribute::AGE_TEENAGER],
        [SecondaryAttribute::AGE_OVER_FORTY, SecondaryAttribute::AGE_CHILD],
        [SecondaryAttribute::AGE_OVER_FORTY, SecondaryAttribute::AGE_TEENAGER],
        [SecondaryAttribute::AGE_ELDERLY, SecondaryAttribute::AGE_CHILD],
        [SecondaryAttribute::AGE_ELDERLY, SecondaryAttribute::AGE_TEENAGER],
    ];

    private const EXCLUSIVE_GROUPS = [
        AttributeSubgroup::RELIGION->value => [
            SecondaryAttribute::RELIGION_CHRISTIAN,
            SecondaryAttribute::RELIGION_MUSLIM,
            SecondaryAttribute::RELIGION_JEWISH,
            SecondaryAttribute::RELIGION_BUDDHIST,
            SecondaryAttribute::RELIGION_ATHEIST,
            SecondaryAttribute::RELIGION_AGNOSTIC,
        ],
    ];

    public static function oppositesOf(Attribute $attribute): array
    {
        $opposites = [];

        foreach (self::PAIRS as [$first, $second]) {
            if ($first === $attribute) {
                $opposites[] = $second;
            }

            if ($second === $attribute) {
                $opposites[] = $first;
            }
        }

        foreach (self::EXCLUSIVE_GROUPS as $members) {
            if (!in_array($attribute, $members, true)) {
                continue;
            }

            foreach ($members as $member) {
                if ($member !== $attribute) {
                    $opposites[] = $member;
                }
            }
        }

        return array_values(array_unique($opposites, SORT_REGULAR));
    }

    public static function allPairs(): array
    {
        $pairs = self::PAIRS;

        foreach (self::EXCLUSIVE_GROUPS as $members) {
            $count = count($members);

            for ($i = 0; $i < $count; $i++) {
                for ($j = $i + 1; $j < $count; $j++) {
                    $pairs[] = [$members[$i], $members[$j]];
                }
            }
        }

        return $pairs;
    }
}

<?php

namespace App\Core\Domain\Attributes\Services;

use App\Core\Domain\Attributes\Enums\AttributeSubgroup;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use App\Core\Domain\Attributes\Interfaces\Attribute;

class AttributeOppositionPolicy
{
    private const PAIRS = [
        [InitialAttribute::SKIN_FAIR, InitialAttribute::SKIN_DARK, []],
        [InitialAttribute::LIVING_ALIVE, InitialAttribute::LIVING_DECEASED, []],
        [InitialAttribute::GENDER_MALE, InitialAttribute::GENDER_FEMALE, []],
        [SecondaryAttribute::POLITICAL_CONSERVATIVE, SecondaryAttribute::POLITICAL_PROGRESSIVE, []],
        [SecondaryAttribute::ALIGNMENT_HEROIC, SecondaryAttribute::ALIGNMENT_VILLAINOUS, []],
        [InitialAttribute::HAIR_STRAIGHT, InitialAttribute::HAIR_WAVY, ['only_opposite_when_first_is_true' => true]],
        [InitialAttribute::HAIR_STRAIGHT, InitialAttribute::HAIR_CURLY, ['only_opposite_when_first_is_true' => true]],
        [InitialAttribute::HAIR_STRAIGHT, InitialAttribute::HAIR_COILY, ['only_opposite_when_first_is_true' => true]],
        [InitialAttribute::HAIR_WAVY, InitialAttribute::HAIR_COILY, ['only_opposite_when_first_is_true' => true]],
        [InitialAttribute::AGE_ADULT, InitialAttribute::AGE_CHILD, []],
        [InitialAttribute::AGE_ADULT, InitialAttribute::AGE_TEENAGER, []],
        [InitialAttribute::AGE_OVER_FORTY, InitialAttribute::AGE_CHILD, []],
        [InitialAttribute::AGE_OVER_FORTY, InitialAttribute::AGE_TEENAGER, []],
        [InitialAttribute::AGE_ELDERLY, InitialAttribute::AGE_CHILD, []],
        [InitialAttribute::AGE_ELDERLY, InitialAttribute::AGE_TEENAGER, []],
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

    public static function oppositesOf(Attribute $attribute, ?float $answerScore = null): array
    {
        $opposites = [];

        foreach (self::PAIRS as [$first, $second, $params]) {
            $negativeAnswer = is_numeric($answerScore) && $answerScore <= 1.50;
            # regra utilizada para evitar que resposta 'cabelo liso = falso'
            # faça com que cabelo cacheado, cabelo crespo, careca sejam = true automaticamente.
            if ($negativeAnswer && ($params['only_opposite_when_first_is_true'] ?? false) == true) {
                continue;
            }

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

        // tentar retornar entity quando possível
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

<?php

namespace App\Core\Domain\Attributes\Enums;

use App\Core\Domain\Attributes\Interfaces\Attribute;

enum SecondaryAttribute: string implements Attribute
{
    case HAIR_WAVY = 'hair_wavy';
    case HAIR_CURLY = 'hair_curly';
    case HAIR_COILY = 'hair_coily';
    case AGE_CHILD = 'age_child';
    case AGE_TEENAGER = 'age_teenager';
    case AGE_OVER_FORTY = 'age_over_forty';
    case AGE_ELDERLY = 'age_elderly';
    case RELIGION_IMPORTANT = 'religion_important';
    case RELIGION_CHRISTIAN = 'religion_christian';
    case RELIGION_MUSLIM = 'religion_muslim';
    case RELIGION_JEWISH = 'religion_jewish';
    case RELIGION_BUDDHIST = 'religion_buddhist';
    case RELIGION_ATHEIST = 'religion_atheist';
    case RELIGION_AGNOSTIC = 'religion_agnostic';
    case POLITICAL_CONSERVATIVE = 'political_conservative';
    case POLITICAL_PROGRESSIVE = 'political_progressive';
    case ALIGNMENT_HEROIC = 'alignment_heroic';
    case ALIGNMENT_VILLAINOUS = 'alignment_villainous';
}

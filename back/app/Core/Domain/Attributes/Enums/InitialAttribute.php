<?php

namespace App\Core\Domain\Attributes\Enums;

use App\Core\Domain\Attributes\Interfaces\Attribute;

enum InitialAttribute: string implements Attribute
{
    case SKIN_FAIR = 'skin_fair';
    case SKIN_DARK = 'skin_dark';
    case HAIR_STRAIGHT = 'hair_straight';
    case HAIR_WAVY = 'hair_wavy';
    case HAIR_CURLY = 'hair_curly';
    case HAIR_COILY = 'hair_coily';
    case AGE_ADULT = 'age_adult';
    case AGE_CHILD = 'age_child';
    case AGE_TEENAGER = 'age_teenager';
    case AGE_OVER_FORTY = 'age_over_forty';
    case AGE_ELDERLY = 'age_elderly';
    case GENDER_MALE = 'gender_male';
    case GENDER_FEMALE = 'gender_female';
    case NATIONALITY_BRAZILIAN = 'nationality_brazilian';
    case NATIONALITY_FICTICIONAL = 'nationality_fictional';
    case LIVING_ALIVE = 'living_alive';
    case LIVING_DECEASED = 'living_deceased';
    case MEDIA_DIGITAL_CONTENT = 'media_digital_content';
}

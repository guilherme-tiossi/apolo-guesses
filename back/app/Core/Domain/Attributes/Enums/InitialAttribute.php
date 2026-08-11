<?php

namespace App\Core\Domain\Attributes\Enums;

use App\Core\Domain\Attributes\Interfaces\Attribute;

enum InitialAttribute: string implements Attribute
{
    case SKIN_FAIR = 'skin_fair';
    case SKIN_DARK = 'skin_dark';
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
    case MEDIA_DIGITAL_CONTENT = 'media_digital_content'; // melhorar fraseamento
}

<?php

namespace App\Core\Domain\Attributes\Enums;

use App\Core\Domain\Attributes\Interfaces\Attribute;

enum InitialAttribute: string implements Attribute
{
    case LIVING_ALIVE = 'living_alive';
    case LIVING_DECEASED = 'living_deceased';
    case AGE_ADULT = 'age_adult';
    case AGE_CHILD = 'age_child';
    case AGE_TEENAGER = 'age_teenager';
    case AGE_ELDERLY = 'age_elderly';
    case GENDER_MALE = 'gender_male';
    case GENDER_FEMALE = 'gender_female';
    case NATIONALITY_BRAZILIAN = 'nationality_brazilian';
    case NATIONALITY_FICTICIONAL = 'nationality_fictional';
}

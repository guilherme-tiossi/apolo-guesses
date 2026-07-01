<?php

namespace App\Core\Domain\Enums;

enum AttributeGroup: int
{
    case APPEARANCE = 1;
    case IDENTITY = 2;
    case PERSONALITY = 4;
    case CAREER = 5;
    case SPORTS = 9;
    case ENTERTAINMENT = 10;
    case HOBBIES = 12;
    case ACCOMPLISHMENTS = 14;
    case HISTORY = 16;
    case GEOGRAPHY = 17;
    case TECHNOLOGY = 18;
    case FICTION = 19;
    case POWERS = 20;
    case MISCELLANEOUS = 24;

    public function label(): string
    {
        return strtolower($this->name);
    }
}
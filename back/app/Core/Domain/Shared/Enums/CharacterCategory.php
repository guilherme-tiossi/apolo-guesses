<?php

namespace App\Core\Domain\Shared\Enums;

enum CharacterCategory: int
{
    case ART = 1;
    case SPORT = 2;
    case POLITICS_AND_MILITARY = 3;
    case SCIENCE_AND_TECHNOLOGY = 4;
    case SOCIAL_MEDIA = 5;
    case TELEVISION = 6;
    case FICTION = 7;
    case FINANCE = 8;
    case RELIGION = 9;

    public function label(): string
    {
        return match ($this) {
            self::ART => 'Arte',
            self::SPORT => 'Esporte',
            self::POLITICS_AND_MILITARY => 'Política e exército',
            self::SCIENCE_AND_TECHNOLOGY => 'Ciência e tecnologia',
            self::SOCIAL_MEDIA => 'Mídias sociais',
            self::TELEVISION => 'Televisão',
            self::FICTION => 'Mundo fictício',
            self::FINANCE => 'Finanças',
            self::RELIGION => 'Religião',
        };
    }
}

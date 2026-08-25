<?php

namespace App\Core\Domain\Shared\Enums;

enum CharacterSubcategory: int
{
    case MUSIC = 1;
    case TV_AND_FILMS = 2;
    case WRITING = 3;
    case POETRY = 4;
    case FICTION = 5;

    case FOOTBALL = 10;
    case COMBAT = 11;
    case MOTORSPORTS = 12;
    case OTHER_SPORTS = 13;

    case POLITICS = 20;
    case MILITARY = 21;

    case SCIENCE = 30;
    case TECHNOLOGY = 31;

    case SOCIAL_MEDIA = 40;

    case TV_PRESENTATION = 50;

    case FINANCE = 60;

    case RELIGION = 70;

    public function category(): CharacterCategory
    {
        return match ($this) {
            self::MUSIC,
            self::TV_AND_FILMS,
            self::WRITING,
            self::POETRY => CharacterCategory::ART,

            self::FICTION => CharacterCategory::FICTION,

            self::FOOTBALL,
            self::COMBAT,
            self::MOTORSPORTS,
            self::OTHER_SPORTS => CharacterCategory::SPORT,

            self::POLITICS,
            self::MILITARY => CharacterCategory::POLITICS_AND_MILITARY,

            self::SCIENCE,
            self::TECHNOLOGY => CharacterCategory::SCIENCE_AND_TECHNOLOGY,

            self::SOCIAL_MEDIA => CharacterCategory::SOCIAL_MEDIA,

            self::TV_PRESENTATION => CharacterCategory::TELEVISION,

            self::FINANCE => CharacterCategory::FINANCE,

            self::RELIGION => CharacterCategory::RELIGION,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::MUSIC => 'Música',
            self::TV_AND_FILMS => 'Televisão e filmes',
            self::WRITING => 'Escrita',
            self::POETRY => 'Poesia',
            self::FICTION => 'Ficção',

            self::FOOTBALL => 'Futebol',
            self::COMBAT => 'Luta',
            self::MOTORSPORTS => 'Automobilismo',
            self::OTHER_SPORTS => 'Outros esportes',

            self::POLITICS => 'Política',
            self::MILITARY => 'Exército',

            self::SCIENCE => 'Ciência',
            self::TECHNOLOGY => 'Tecnologia',

            self::SOCIAL_MEDIA => 'Mídias sociais',

            self::TV_PRESENTATION => 'Apresentação televisiva',

            self::FINANCE => 'Finanças',

            self::RELIGION => 'Religião',
        };
    }
}

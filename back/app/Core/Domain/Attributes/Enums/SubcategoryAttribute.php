<?php

namespace App\Core\Domain\Attributes\Enums;

use App\Core\Domain\Attributes\Interfaces\Attribute;
use App\Core\Domain\Shared\Enums\CharacterSubcategory;

enum SubcategoryAttribute: string implements Attribute
{
    case MUSIC = 'subcategory_music';
    case TV_AND_FILMS = 'subcategory_tv_and_films';
    case WRITING = 'subcategory_writing';
    case POETRY = 'subcategory_poetry';
    case FICTION = 'subcategory_fiction';

    case FOOTBALL = 'subcategory_football';
    case COMBAT = 'subcategory_combat';
    case MOTORSPORTS = 'subcategory_motorsports';
    case OTHER_SPORTS = 'subcategory_other_sports';

    case POLITICS = 'subcategory_politics';
    case MILITARY = 'subcategory_military';

    case SCIENCE = 'subcategory_science';
    case TECHNOLOGY = 'subcategory_technology';

    case SOCIAL_MEDIA = 'subcategory_social_media';
    case TV_PRESENTATION = 'subcategory_tv_presentation';
    case FINANCE = 'subcategory_finance';
    case RELIGION = 'religion_important';

    public static function fromSubcategory(CharacterSubcategory $subcategory): self
    {
        return match ($subcategory) {
            CharacterSubcategory::MUSIC => self::MUSIC,
            CharacterSubcategory::TV_AND_FILMS => self::TV_AND_FILMS,
            CharacterSubcategory::WRITING => self::WRITING,
            CharacterSubcategory::POETRY => self::POETRY,
            CharacterSubcategory::FICTION => self::FICTION,
            CharacterSubcategory::FOOTBALL => self::FOOTBALL,
            CharacterSubcategory::COMBAT => self::COMBAT,
            CharacterSubcategory::MOTORSPORTS => self::MOTORSPORTS,
            CharacterSubcategory::OTHER_SPORTS => self::OTHER_SPORTS,
            CharacterSubcategory::POLITICS => self::POLITICS,
            CharacterSubcategory::MILITARY => self::MILITARY,
            CharacterSubcategory::SCIENCE => self::SCIENCE,
            CharacterSubcategory::TECHNOLOGY => self::TECHNOLOGY,
            CharacterSubcategory::SOCIAL_MEDIA => self::SOCIAL_MEDIA,
            CharacterSubcategory::TV_PRESENTATION => self::TV_PRESENTATION,
            CharacterSubcategory::FINANCE => self::FINANCE,
            CharacterSubcategory::RELIGION => self::RELIGION,
        };
    }
}

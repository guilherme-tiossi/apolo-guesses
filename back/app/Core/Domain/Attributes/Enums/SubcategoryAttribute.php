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
    case FICTION_SUPERHEROES = 'subcategory_fiction_superheroes';
    case FICTION_ANIMATION = 'subcategory_fiction_animation';
    case FICTION_ANIME = 'subcategory_fiction_anime';
    case FICTION_BRAZILIAN = 'subcategory_fiction_brazilian';
    case FICTION_VIDEO_GAMES = 'subcategory_fiction_video_games';
    case FICTION_LIVE_ACTION = 'subcategory_fiction_live_action';
    case FICTION_CHILDREN = 'subcategory_fiction_children';
    case FICTION_YOUNG_ADULT = 'subcategory_fiction_young_adult';
    case FICTION_MYSTERY = 'subcategory_fiction_mystery';
    case FICTION_COMEDY = 'subcategory_fiction_comedy';
    case FICTION_FANTASY = 'subcategory_fiction_fantasy';
    case FICTION_SCI_FI = 'subcategory_fiction_sci_fi';
    case FICTION_HORROR = 'subcategory_fiction_horror';

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
            CharacterSubcategory::FICTION_SUPERHEROES => self::FICTION_SUPERHEROES,
            CharacterSubcategory::FICTION_ANIMATION => self::FICTION_ANIMATION,
            CharacterSubcategory::FICTION_ANIME => self::FICTION_ANIME,
            CharacterSubcategory::FICTION_BRAZILIAN => self::FICTION_BRAZILIAN,
            CharacterSubcategory::FICTION_VIDEO_GAMES => self::FICTION_VIDEO_GAMES,
            CharacterSubcategory::FICTION_LIVE_ACTION => self::FICTION_LIVE_ACTION,
            CharacterSubcategory::FICTION_CHILDREN => self::FICTION_CHILDREN,
            CharacterSubcategory::FICTION_YOUNG_ADULT => self::FICTION_YOUNG_ADULT,
            CharacterSubcategory::FICTION_MYSTERY => self::FICTION_MYSTERY,
            CharacterSubcategory::FICTION_COMEDY => self::FICTION_COMEDY,
            CharacterSubcategory::FICTION_FANTASY => self::FICTION_FANTASY,
            CharacterSubcategory::FICTION_SCI_FI => self::FICTION_SCI_FI,
            CharacterSubcategory::FICTION_HORROR => self::FICTION_HORROR,
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

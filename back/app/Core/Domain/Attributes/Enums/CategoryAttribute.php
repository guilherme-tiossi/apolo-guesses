<?php

namespace App\Core\Domain\Attributes\Enums;

use App\Core\Domain\Attributes\Interfaces\Attribute;
use App\Core\Domain\Shared\Enums\CharacterCategory;

enum CategoryAttribute: string implements Attribute
{
    case ART = 'category_art';
    case SPORT = 'category_sport';
    case POLITICS_AND_MILITARY = 'category_politics_and_military';
    case SCIENCE_AND_TECHNOLOGY = 'category_science_and_technology';
    case SOCIAL_MEDIA = 'category_social_media';
    case TELEVISION = 'category_television';
    case FICTION = 'category_fiction';
    case FINANCE = 'category_finance';
    case RELIGION = 'category_religion';

    public static function fromCategory(CharacterCategory $category): self
    {
        return match ($category) {
            CharacterCategory::ART => self::ART,
            CharacterCategory::SPORT => self::SPORT,
            CharacterCategory::POLITICS_AND_MILITARY => self::POLITICS_AND_MILITARY,
            CharacterCategory::SCIENCE_AND_TECHNOLOGY => self::SCIENCE_AND_TECHNOLOGY,
            CharacterCategory::SOCIAL_MEDIA => self::SOCIAL_MEDIA,
            CharacterCategory::TELEVISION => self::TELEVISION,
            CharacterCategory::FICTION => self::FICTION,
            CharacterCategory::FINANCE => self::FINANCE,
            CharacterCategory::RELIGION => self::RELIGION,
        };
    }
}

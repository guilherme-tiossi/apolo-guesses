<?php

namespace App\Core\Domain\Shared\Enums;

use App\Core\Domain\Attributes\Enums\CategoryAttribute;

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

    public function attributeId(): int
    {
        return match ($this) {
            self::ART => 1,
            self::SPORT => 2,
            self::POLITICS_AND_MILITARY => 3,
            self::SCIENCE_AND_TECHNOLOGY => 4,
            self::SOCIAL_MEDIA => 5,
            self::TELEVISION => 6,
            self::FICTION => 7,
            self::FINANCE => 8,
            self::RELIGION => 9,
        };
    }

    public static function attributeIds(): array
    {
        return array_map(fn (self $category) => $category->attributeId(), self::cases());
    }

    public static function tryFromAttributeId(int $attributeId): ?self
    {
        foreach (self::cases() as $category) {
            if ($category->attributeId() === $attributeId) {
                return $category;
            }
        }

        return null;
    }

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

    public function attribute(): CategoryAttribute
    {
        return CategoryAttribute::fromCategory($this);
    }

    public function labelEn(): string
    {
        return match ($this) {
            self::ART => 'art and entertainment',
            self::SPORT => 'sports',
            self::POLITICS_AND_MILITARY => 'politics and the military',
            self::SCIENCE_AND_TECHNOLOGY => 'science and technology',
            self::SOCIAL_MEDIA => 'social media',
            self::TELEVISION => 'television',
            self::FICTION => 'fiction',
            self::FINANCE => 'finance',
            self::RELIGION => 'religion',
        };
    }

    public function labelPt(): string
    {
        return match ($this) {
            self::ART => 'arte e entretenimento',
            self::SPORT => 'esportes',
            self::POLITICS_AND_MILITARY => 'política e exército',
            self::SCIENCE_AND_TECHNOLOGY => 'ciência e tecnologia',
            self::SOCIAL_MEDIA => 'mídias sociais',
            self::TELEVISION => 'televisão',
            self::FICTION => 'ficção',
            self::FINANCE => 'finanças',
            self::RELIGION => 'religião',
        };
    }

    public function questionEn(): string
    {
        return sprintf(
            'Does your character mainly work in the area of %s?',
            $this->labelEn()
        );
    }

    public function questionPt(): string
    {
        return sprintf(
            'Seu personagem atua principalmente na área de %s?',
            $this->labelPt()
        );
    }
}

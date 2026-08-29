<?php

namespace App\Core\Domain\Shared\Enums;

use App\Core\Domain\Attributes\Enums\SubcategoryAttribute;

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

    public function attribute(): SubcategoryAttribute
    {
        return SubcategoryAttribute::fromSubcategory($this);
    }

    public function questionEn(): string
    {
        return match ($this) {
            self::MUSIC => 'Is your character active in music?',
            self::TV_AND_FILMS => 'Is your character an actor?',
            self::WRITING => 'Is your character active in literature?',
            self::POETRY => 'Is your character associated with poetry?',
            self::FICTION => 'Is your character from fiction?',

            self::FOOTBALL => 'Does your character play football professionally?',
            self::COMBAT => 'Does your character compete in high-level combat tournaments?',
            self::MOTORSPORTS => 'Is your character associated with motorsports?',
            self::OTHER_SPORTS => 'Is your character associated with other sports?',

            self::POLITICS => 'Is your character a politician?',
            self::MILITARY => 'Did your character act as a military leader?',

            self::SCIENCE => 'Is your character a scientist?',
            self::TECHNOLOGY => 'Is your character associated with technology?',

            self::SOCIAL_MEDIA => 'Is your character known for large follower counts?',
            self::TV_PRESENTATION => 'Is your character a TV host?',
            self::FINANCE => 'Is your character an investor?',
            self::RELIGION => 'Is religion one of the defining traits of your character?',
        };
    }

    public function questionPt(): string
    {
        return match ($this) {
            self::MUSIC => 'Seu personagem atua em música?',
            self::TV_AND_FILMS => 'Seu personagem é ator?',
            self::WRITING => 'Seu personagem atua em literatura?',
            self::POETRY => 'Seu personagem está associado a poesia?',
            self::FICTION => 'Seu personagem é de ficção?',

            self::FOOTBALL => 'Seu personagem joga futebol profissionalmente?',
            self::COMBAT => 'Seu personagem compete em torneios de combate de alto nivel?',
            self::MOTORSPORTS => 'Seu personagem está associado a automobilismo?',
            self::OTHER_SPORTS => 'Seu personagem está associado a outros esportes?',

            self::POLITICS => 'Seu personagem é político?',
            self::MILITARY => 'Seu personagem atuou como lider militar?',

            self::SCIENCE => 'Seu personagem é cientista?',
            self::TECHNOLOGY => 'Seu personagem está associado a tecnologia?',

            self::SOCIAL_MEDIA => 'Seu personagem é conhecido por grande numero de seguidores?',
            self::TV_PRESENTATION => 'Seu personagem é apresentador de TV?',
            self::FINANCE => 'Seu personagem é investidor?',
            self::RELIGION => 'A religião é um dos aspectos principais de seu personagem?',
        };
    }
}

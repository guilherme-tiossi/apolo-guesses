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
    case FICTION_SUPERHEROES = 80;
    case FICTION_ANIMATION = 81;
    case FICTION_ANIME = 82;
    case FICTION_BRAZILIAN = 83;
    case FICTION_VIDEO_GAMES = 84;
    case FICTION_LIVE_ACTION = 85;
    case FICTION_CHILDREN = 86;
    case FICTION_YOUNG_ADULT = 87;
    case FICTION_MYSTERY = 88;
    case FICTION_COMEDY = 89;
    case FICTION_FANTASY = 90;
    case FICTION_SCI_FI = 91;
    case FICTION_HORROR = 92;

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

    public function attributeId(): int
    {
        return match ($this) {
            self::MUSIC => 10,
            self::TV_AND_FILMS => 11,
            self::WRITING => 12,
            self::POETRY => 13,
            self::FICTION => 14,
            self::FICTION_SUPERHEROES => 27,
            self::FICTION_ANIMATION => 28,
            self::FICTION_ANIME => 29,
            self::FICTION_BRAZILIAN => 30,
            self::FICTION_VIDEO_GAMES => 31,
            self::FICTION_LIVE_ACTION => 32,
            self::FICTION_CHILDREN => 33,
            self::FICTION_YOUNG_ADULT => 34,
            self::FICTION_MYSTERY => 35,
            self::FICTION_COMEDY => 36,
            self::FICTION_FANTASY => 37,
            self::FICTION_SCI_FI => 38,
            self::FICTION_HORROR => 39,
            self::FOOTBALL => 15,
            self::COMBAT => 16,
            self::MOTORSPORTS => 17,
            self::OTHER_SPORTS => 18,
            self::POLITICS => 19,
            self::MILITARY => 20,
            self::SCIENCE => 21,
            self::TECHNOLOGY => 22,
            self::SOCIAL_MEDIA => 23,
            self::TV_PRESENTATION => 24,
            self::FINANCE => 25,
            self::RELIGION => 26,
        };
    }

    public static function attributeIds(): array
    {
        return array_map(fn (self $subcategory) => $subcategory->attributeId(), self::cases());
    }

    public static function tryFromAttributeId(int $attributeId): ?self
    {
        foreach (self::cases() as $subcategory) {
            if ($subcategory->attributeId() === $attributeId) {
                return $subcategory;
            }
        }

        return null;
    }

    public function category(): CharacterCategory
    {
        return match ($this) {
            self::MUSIC,
            self::TV_AND_FILMS,
            self::WRITING,
            self::POETRY => CharacterCategory::ART,

            self::FICTION,
            self::FICTION_SUPERHEROES,
            self::FICTION_ANIMATION,
            self::FICTION_ANIME,
            self::FICTION_BRAZILIAN,
            self::FICTION_VIDEO_GAMES,
            self::FICTION_LIVE_ACTION,
            self::FICTION_CHILDREN,
            self::FICTION_YOUNG_ADULT,
            self::FICTION_MYSTERY,
            self::FICTION_COMEDY,
            self::FICTION_FANTASY,
            self::FICTION_SCI_FI,
            self::FICTION_HORROR => CharacterCategory::FICTION,

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
            self::FICTION_SUPERHEROES => 'Super-heróis e quadrinhos',
            self::FICTION_ANIMATION => 'Animação',
            self::FICTION_ANIME => 'Anime',
            self::FICTION_BRAZILIAN => 'Ficção brasileira',
            self::FICTION_VIDEO_GAMES => 'Games',
            self::FICTION_LIVE_ACTION => 'Live-action',
            self::FICTION_CHILDREN => 'Infantil',
            self::FICTION_YOUNG_ADULT => 'Infanto-juvenil',
            self::FICTION_MYSTERY => 'Mistério',
            self::FICTION_COMEDY => 'Comédia',
            self::FICTION_FANTASY => 'Fantasia',
            self::FICTION_SCI_FI => 'Ficção científica',
            self::FICTION_HORROR => 'Terror',

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
            self::FICTION_SUPERHEROES => 'Is your character a superhero?',
            self::FICTION_ANIMATION => 'Is your character from an animated show or movie?',
            self::FICTION_ANIME => 'Is your character from an anime?',
            self::FICTION_BRAZILIAN => 'Is your character from Brazilian comics or TV comedy?',
            self::FICTION_VIDEO_GAMES => 'Is your character from a video game?',
            self::FICTION_LIVE_ACTION => 'Is your character from a live-action film or series?',
            self::FICTION_CHILDREN => 'Is your character aimed at a children\'s audience?',
            self::FICTION_YOUNG_ADULT => 'Is your character popular with teenagers or young adults?',
            self::FICTION_MYSTERY => 'Is your character associated with mysteries or investigations?',
            self::FICTION_COMEDY => 'Is your character from a comedy?',
            self::FICTION_FANTASY => 'Is your character from a fantasy setting?',
            self::FICTION_SCI_FI => 'Is your character from a science fiction setting?',
            self::FICTION_HORROR => 'Is your character from a horror story?',

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
            self::FICTION_SUPERHEROES => 'Seu personagem é um super-herói?',
            self::FICTION_ANIMATION => 'Seu personagem é de desenho animado ou filme de animação?',
            self::FICTION_ANIME => 'Seu personagem é de anime?',
            self::FICTION_BRAZILIAN => 'Seu personagem é de quadrinhos ou comédia de TV brasileira?',
            self::FICTION_VIDEO_GAMES => 'Seu personagem é de videogame?',
            self::FICTION_LIVE_ACTION => 'Seu personagem é de filme ou série live-action?',
            self::FICTION_CHILDREN => 'Seu personagem é voltado ao público infantil?',
            self::FICTION_YOUNG_ADULT => 'Seu personagem é popular entre adolescentes ou jovens adultos?',
            self::FICTION_MYSTERY => 'Seu personagem está associado a mistérios ou investigações?',
            self::FICTION_COMEDY => 'Seu personagem é de comédia?',
            self::FICTION_FANTASY => 'Seu personagem é de um universo de fantasia?',
            self::FICTION_SCI_FI => 'Seu personagem é de ficção científica?',
            self::FICTION_HORROR => 'Seu personagem é de uma história de terror?',

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

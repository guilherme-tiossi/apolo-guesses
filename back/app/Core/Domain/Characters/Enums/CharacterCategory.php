<?php

namespace App\Core\Domain\Characters\Enums;

enum CharacterCategory: int
{
    case FOOTBALL_PLAYER = 1;
    case BASKETBALL_PLAYER = 2;
    case MMA_FIGHTER = 3;
    case BOXER = 4;
    case TENNIS_PLAYER = 5;
    case F1_DRIVER = 6;
    case SURFER = 7;
    case OLYMPIC_ATHLETE = 8;
    case CHEF = 9;
    case TV_HOST = 10;
    case YOUTUBER = 11;
    case INFLUENCER = 12;
    case ACTOR = 13;
    case ACTRESS = 14;
    case MALE_SINGER = 15;
    case FEMALE_SINGER = 16;
    case COMPOSER = 17;
    case FILM_DIRECTOR = 18;
    case COMEDIAN = 19;
    case POLITICIAN = 20;
    case HISTORICAL_FIGURE = 21;
    case MONARCH = 22;
    case PHILOSOPHER = 23;
    case SCIENTIST = 24;
    case WRITER = 25;
    case POET = 26;
    case PAINTER = 27;
    case SCULPTOR = 28;
    case PHOTOGRAPHER = 29;
    case JOURNALIST = 30;
    case SPORTS_REPORTER = 31;
    case ENTREPRENEUR = 32;
    case INVESTOR = 33;
    case TECH_CEO = 34;
    case GAMER_STREAMER = 35;
    case DJ = 36;
    case MODEL = 37;
    case FASHION_DESIGNER = 38;
    case MILITARY = 39;
    case RELIGIOUS_LEADER = 40;
    case ASTRONAUT = 41;
    case DOCTOR = 42;
    case LAWYER = 43;
    case FICTIONAL_CHARACTER = 44;
    case RADIO_HOST = 45;
    case MAGICIAN = 46;
    case DANCER = 47;
    case PASTRY_CHEF = 48;
    case CARTOON_CHARACTER = 49;

    public function label(): string
    {
        return match ($this) {
            self::FOOTBALL_PLAYER => 'Futebolista',
            self::BASKETBALL_PLAYER => 'Jogador de basquete',
            self::MMA_FIGHTER => 'Lutador de MMA',
            self::BOXER => 'Boxeador',
            self::TENNIS_PLAYER => 'Tenista',
            self::F1_DRIVER => 'Piloto de Fórmula 1',
            self::SURFER => 'Surfista',
            self::OLYMPIC_ATHLETE => 'Atleta olímpico',
            self::CHEF => 'Cozinheiro / Chef',
            self::TV_HOST => 'Apresentador de TV',
            self::YOUTUBER => 'Youtuber',
            self::INFLUENCER => 'Influenciador',
            self::ACTOR => 'Ator',
            self::ACTRESS => 'Atriz',
            self::MALE_SINGER => 'Cantor',
            self::FEMALE_SINGER => 'Cantora',
            self::COMPOSER => 'Compositor',
            self::FILM_DIRECTOR => 'Diretor de cinema',
            self::COMEDIAN => 'Comediante / Humorista',
            self::POLITICIAN => 'Político',
            self::HISTORICAL_FIGURE => 'Figura histórica',
            self::MONARCH => 'Rei / Imperador',
            self::PHILOSOPHER => 'Filósofo',
            self::SCIENTIST => 'Cientista',
            self::WRITER => 'Escritor',
            self::POET => 'Poeta',
            self::PAINTER => 'Pintor',
            self::SCULPTOR => 'Escultor',
            self::PHOTOGRAPHER => 'Fotógrafo',
            self::JOURNALIST => 'Jornalista',
            self::SPORTS_REPORTER => 'Repórter esportivo',
            self::ENTREPRENEUR => 'Empresário',
            self::INVESTOR => 'Investidor',
            self::TECH_CEO => 'CEO de tech',
            self::GAMER_STREAMER => 'Gamer / streamer',
            self::DJ => 'DJ',
            self::MODEL => 'Modelo',
            self::FASHION_DESIGNER => 'Designer de moda',
            self::MILITARY => 'Militar',
            self::RELIGIOUS_LEADER => 'Líder religioso',
            self::ASTRONAUT => 'Astronauta',
            self::DOCTOR => 'Médico',
            self::LAWYER => 'Advogado',
            self::FICTIONAL_CHARACTER => 'Personagem fictício',
            self::RADIO_HOST => 'Apresentador de rádio',
            self::MAGICIAN => 'Mágico / ilusionista',
            self::DANCER => 'Dançarino',
            self::PASTRY_CHEF => 'Chef de confeitaria',
            self::CARTOON_CHARACTER => 'Personagem de desenho animado',
        };
    }
}

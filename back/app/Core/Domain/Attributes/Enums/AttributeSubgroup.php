<?php

namespace App\Core\Domain\Attributes\Enums;

enum AttributeSubgroup: int
{
    // appearance
    case HEIGHT = 1;
    case WEIGHT = 2;
    case BUILD = 3;
    case SKIN_COLOR = 4;
    case HAIR_COLOR = 5;
    case HAIR_LENGTH = 6;
    case HAIR_STYLE = 7;
    case HAIR_TEXTURE = 8;
    case FACIAL_HAIR = 9;
    case EYE_COLOR = 10;
    case FACIAL_FEATURES = 11;
    case SPECIES = 12;
    case STYLE = 18;
    case DISABILITIES = 19;
    case DISTINCTIVE_FEATURES = 20;

    // identity
    case AGE = 23;
    case GENDER = 24;
    case SEXUAL_ORIENTATION = 25;
    case NATIONALITY = 26;
    case ETHNICITY = 27;
    case LANGUAGES = 29;
    case IDENTITY_TITLES = 30;
    case LIVING_STATUS = 31;
    case BIRTH_ORIGIN = 32;
    case RELIGION = 34;
    case FAMILY = 35;
    case POLITICAL_PROFILE = 36;
    case EDUCATION = 37;

    // personality
    case TEMPERAMENT = 43;
    case INTELLIGENCE = 44;
    case HUMOR = 45;
    case LEADERSHIP = 46;
    case MORALITY = 47;
    case HEALTH = 48;
    case EMOTIONS = 49;
    case HABITS = 50;
    case LIFESTYLE = 51;
    case BELIEFS = 52;

    // career
    case PROFESSION = 53;
    case INDUSTRY = 54;
    case ARTS = 55;
    case SCIENCE = 56;
    case BUSINESS = 57;
    case MEDICINE = 58;
    case LAW = 59;
    case MEDIA = 60;
    case PUBLIC_SERVICE = 61;
    case MILITARY_CAREER = 62;

    // sports
    case FOOTBALL = 80;
    case BASKETBALL = 81;
    case OTHER_SPORTS = 82;
    case COMBAT_SPORTS = 85;
    case ESPORTS = 88;
    case SPORT_ROLES = 89;

    // entertainment
    case MOVIES = 90;
    case TELEVISION = 91;
    case MUSIC = 92;
    case THEATER = 93;
    case LITERATURE = 94;
    case COMICS = 95;
    case ANIME_MANGA = 96;
    case STREAMING = 97;
    case SOCIAL_MEDIA = 98;

    // hobbies
    case ARTS_AND_CRAFTS = 105;
    case COLLECTING = 106;
    case TRAVEL = 107;
    case READING = 108;
    case GAMING = 109;
    case COOKING = 110;
    case GARDENING = 111;
    case FITNESS = 112;
    case OUTDOOR_ACTIVITIES = 113;

    // accomplishments
    case AWARDS = 124;
    case RECORDS = 125;
    case ACCOMPLISHMENT_TITLES = 126;
    case CERTIFICATIONS = 127;
    case RECOGNITION = 128;

    // history
    case HISTORICAL_PERIOD = 129;
    case HISTORICAL_EVENT = 130;
    case HISTORICAL_ROLE = 131;
    case HISTORICAL_IMPACT = 132;

    // geography
    case CONTINENT = 133;
    case COUNTRY = 134;
    case STATE_OR_PROVINCE = 135;
    case CITY = 136;
    case REGION = 137;

    // technology
    case COMPUTING = 140;
    case PROGRAMMING = 141;
    case ARTIFICIAL_INTELLIGENCE = 142;
    case ELECTRONICS = 143;
    case INTERNET_TECHNOLOGY = 144;
    case SPACE_TECHNOLOGY = 145;
    case VEHICLES = 146;
    case WEAPONS = 147;

    // fiction
    case ALIGNMENT = 148;
    case ROLE = 149;
    case OCCUPATION = 150;
    case ORIGIN = 151;
    case UNIVERSE = 152;
    case ORGANIZATION = 153;
    case EQUIPMENT = 154;
    case TRANSFORMATION = 155;

    // powers
    case PHYSICAL_POWERS = 156;
    case ELEMENTAL_POWERS = 157;
    case MENTAL_POWERS = 158;
    case MAGICAL_POWERS = 159;
    case SPACE_TIME_POWERS = 160;
    case MOVEMENT_POWERS = 161;
    case DEFENSIVE_POWERS = 162;
    case OFFENSIVE_POWERS = 163;
    case SPECIAL_ABILITIES = 164;

    // miscellaneous
    case NICKNAMES = 165;
    case LEGAL = 166;
    case PHILANTHROPY = 167;
    case CONTROVERSIES = 168;
    case CATCHPHRASES = 169;
    case RIVALRIES = 171;
    case SIGNATURE_TRAITS = 172;

    public function group(): AttributeGroup
    {
        return match ($this) {
            self::HEIGHT,
            self::WEIGHT,
            self::BUILD,
            self::SKIN_COLOR,
            self::HAIR_COLOR,
            self::HAIR_LENGTH,
            self::HAIR_STYLE,
            self::HAIR_TEXTURE,
            self::FACIAL_HAIR,
            self::EYE_COLOR,
            self::FACIAL_FEATURES,
            self::SPECIES,
            self::STYLE,
            self::DISABILITIES,
            self::DISTINCTIVE_FEATURES => AttributeGroup::APPEARANCE,

            self::AGE,
            self::GENDER,
            self::SEXUAL_ORIENTATION,
            self::NATIONALITY,
            self::ETHNICITY,
            self::LANGUAGES,
            self::IDENTITY_TITLES,
            self::LIVING_STATUS,
            self::BIRTH_ORIGIN,
            self::RELIGION,
            self::FAMILY,
            self::POLITICAL_PROFILE,
            self::EDUCATION => AttributeGroup::IDENTITY,

            self::TEMPERAMENT,
            self::INTELLIGENCE,
            self::HUMOR,
            self::LEADERSHIP,
            self::MORALITY,
            self::HEALTH,
            self::EMOTIONS,
            self::HABITS,
            self::LIFESTYLE,
            self::BELIEFS => AttributeGroup::PERSONALITY,

            self::PROFESSION,
            self::INDUSTRY,
            self::ARTS,
            self::SCIENCE,
            self::BUSINESS,
            self::MEDICINE,
            self::LAW,
            self::MEDIA,
            self::PUBLIC_SERVICE,
            self::MILITARY_CAREER => AttributeGroup::CAREER,

            self::FOOTBALL,
            self::BASKETBALL,
            self::OTHER_SPORTS,
            self::COMBAT_SPORTS,
            self::ESPORTS,
            self::SPORT_ROLES => AttributeGroup::SPORTS,

            self::MOVIES,
            self::TELEVISION,
            self::MUSIC,
            self::THEATER,
            self::LITERATURE,
            self::COMICS,
            self::ANIME_MANGA,
            self::STREAMING,
            self::SOCIAL_MEDIA => AttributeGroup::ENTERTAINMENT,

            self::ARTS_AND_CRAFTS,
            self::COLLECTING,
            self::TRAVEL,
            self::READING,
            self::GAMING,
            self::COOKING,
            self::GARDENING,
            self::FITNESS,
            self::OUTDOOR_ACTIVITIES => AttributeGroup::HOBBIES,

            self::AWARDS,
            self::RECORDS,
            self::ACCOMPLISHMENT_TITLES,
            self::CERTIFICATIONS,
            self::RECOGNITION => AttributeGroup::ACCOMPLISHMENTS,

            self::HISTORICAL_PERIOD,
            self::HISTORICAL_EVENT,
            self::HISTORICAL_ROLE,
            self::HISTORICAL_IMPACT => AttributeGroup::HISTORY,

            self::CONTINENT,
            self::COUNTRY,
            self::STATE_OR_PROVINCE,
            self::CITY,
            self::REGION => AttributeGroup::GEOGRAPHY,

            self::COMPUTING,
            self::PROGRAMMING,
            self::ARTIFICIAL_INTELLIGENCE,
            self::ELECTRONICS,
            self::INTERNET_TECHNOLOGY,
            self::SPACE_TECHNOLOGY,
            self::VEHICLES,
            self::WEAPONS => AttributeGroup::TECHNOLOGY,

            self::ALIGNMENT,
            self::ROLE,
            self::OCCUPATION,
            self::ORIGIN,
            self::UNIVERSE,
            self::ORGANIZATION,
            self::EQUIPMENT,
            self::TRANSFORMATION => AttributeGroup::FICTION,

            self::PHYSICAL_POWERS,
            self::ELEMENTAL_POWERS,
            self::MENTAL_POWERS,
            self::MAGICAL_POWERS,
            self::SPACE_TIME_POWERS,
            self::MOVEMENT_POWERS,
            self::DEFENSIVE_POWERS,
            self::OFFENSIVE_POWERS,
            self::SPECIAL_ABILITIES => AttributeGroup::POWERS,

            self::NICKNAMES,
            self::LEGAL,
            self::PHILANTHROPY,
            self::CONTROVERSIES,
            self::CATCHPHRASES,
            self::RIVALRIES,
            self::SIGNATURE_TRAITS => AttributeGroup::MISCELLANEOUS,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::IDENTITY_TITLES,
            self::ACCOMPLISHMENT_TITLES => 'titles',
            default => strtolower($this->name),
        };
    }
}

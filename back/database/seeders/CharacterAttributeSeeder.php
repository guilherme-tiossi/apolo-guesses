<?php

namespace Database\Seeders;

use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CharacterAttributeSeeder extends Seeder
{
    private const REQUIRED_INITIAL_GROUPS = [
        'skin' => [InitialAttribute::SKIN_FAIR, InitialAttribute::SKIN_DARK],
        'hair' => [
            InitialAttribute::HAIR_STRAIGHT,
            InitialAttribute::HAIR_WAVY,
            InitialAttribute::HAIR_CURLY,
            InitialAttribute::HAIR_COILY,
        ],
        'age' => [
            InitialAttribute::AGE_ADULT,
            InitialAttribute::AGE_CHILD,
            InitialAttribute::AGE_TEENAGER,
            InitialAttribute::AGE_OVER_FORTY,
            InitialAttribute::AGE_ELDERLY,
        ],
        'gender' => [InitialAttribute::GENDER_MALE, InitialAttribute::GENDER_FEMALE],
        'living' => [InitialAttribute::LIVING_ALIVE, InitialAttribute::LIVING_DECEASED],
    ];

    public function run(): void
    {
        $this->pele();
        $this->muhammadAli();
        $this->ayrtonSenna();
        $this->rebecaAndrade();
        $this->anaMariaBraga();
        $this->silvioSantos();
    }

    /**
     * @param  array<int|string, array{0: InitialAttribute|SecondaryAttribute, 1: float|int}|float|int>  $attributes
     */
    private function seedCharacter(string $characterName, array $attributes): void
    {
        $characterId = $this->characterId($characterName);
        $initialNames = [];

        foreach ($attributes as $key => $value) {
            if (is_int($key)) {
                if (!is_array($value) || count($value) !== 2) {
                    throw new RuntimeException(
                        "Invalid enum attribute entry for {$characterName}. Expected [Enum, score]."
                    );
                }

                [$attribute, $score] = $value;

                if (!$attribute instanceof InitialAttribute && !$attribute instanceof SecondaryAttribute) {
                    throw new RuntimeException(
                        "Invalid enum attribute for {$characterName}. Expected InitialAttribute|SecondaryAttribute."
                    );
                }

                if ($attribute instanceof InitialAttribute) {
                    $initialNames[] = $attribute->value;
                }

                DB::table('character_attributes')->updateOrInsert(
                    [
                        'character_id' => $characterId,
                        'attribute_id' => $this->attributeIdByInternalName($attribute->value),
                    ],
                    [
                        'score' => $score,
                    ]
                );

                continue;
            }

            DB::table('character_attributes')->updateOrInsert(
                [
                    'character_id' => $characterId,
                    'attribute_id' => $this->attributeIdByQuestion($key),
                ],
                [
                    'score' => $value,
                ]
            );
        }

        $this->assertRequiredInitialAttributes($characterName, $initialNames);
    }

    private function assertRequiredInitialAttributes(string $characterName, array $initialNames): void
    {
        foreach (self::REQUIRED_INITIAL_GROUPS as $group => $options) {
            $covered = false;

            foreach ($options as $option) {
                if (in_array($option->value, $initialNames, true)) {
                    $covered = true;
                    break;
                }
            }

            if (!$covered) {
                $expected = implode(', ', array_map(
                    static fn (InitialAttribute $attribute): string => $attribute->value,
                    $options
                ));

                throw new RuntimeException(
                    "Character {$characterName} is missing required InitialAttribute group [{$group}]. Expected one of: {$expected}"
                );
            }
        }
    }

    private function characterId(string $name): int
    {
        $id = DB::table('characters')->where('name', $name)->value('id');

        if ($id === null) {
            throw new RuntimeException("Character not found: {$name}");
        }

        return $id;
    }

    private function attributeIdByQuestion(string $question): int
    {
        $id = DB::table('attributes')->where('question', $question)->value('id');

        if ($id === null) {
            throw new RuntimeException("Attribute not found: {$question}");
        }

        return $id;
    }

    private function attributeIdByInternalName(string $internalName): int
    {
        $id = DB::table('attributes')->where('internal_name', $internalName)->value('id');

        if ($id === null) {
            throw new RuntimeException("Attribute not found by internal_name: {$internalName}");
        }

        return $id;
    }

    private function pele(): void
    {
        $this->seedCharacter('Pelé', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::HAIR_CURLY, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],
            [SecondaryAttribute::RELIGION_IMPORTANT, 1],

            'Is your character described as black?' => 2,
            'Does your character have a athletic build?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character have football as main identity?' => 2,
            'Is your character mainly a player?' => 2,
            'Was your character born in Brazil?' => 2,
            'Has your character won major international awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
        ]);
    }

    private function muhammadAli(): void
    {
        $this->seedCharacter('Muhammad Ali', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::HAIR_COILY, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            [SecondaryAttribute::RELIGION_MUSLIM, 2],
            [SecondaryAttribute::RELIGION_IMPORTANT, 2],
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 2],

            'Is your character American?' => 2,
            'Is your character described as black?' => 2,
            'Does your character have a muscular build?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character compete in boxing?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Is your character mainly a player?' => 2,
            'Has your character won major international awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Does your character have an iconic catchphrase?' => 2,
            'Is your character associated with political controversy?' => 1.5,
            'Does your character inspire others?' => 2,
        ]);
    }

    private function ayrtonSenna(): void
    {
        $this->seedCharacter('Ayrton Senna', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::HAIR_WAVY, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            [SecondaryAttribute::RELIGION_CHRISTIAN, 2],
            [SecondaryAttribute::RELIGION_IMPORTANT, 2],

            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Is your character associated with motorsports?' => 2,
            'Was your character born in Brazil?' => 2,
            'Is your character impulsive?' => 1.5,
            'Does your character take command in crisis?' => 2,
            'Does your character inspire others?' => 2,
            'Does your character hold a speed record?' => 2,
            'Does your character hold multiple records?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character mainly a player?' => 2,
        ]);
    }

    private function rebecaAndrade(): void
    {
        $this->seedCharacter('Rebeca Andrade', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::HAIR_CURLY, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],

            'Is your character described as black?' => 2,
            'Does your character have a athletic build?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Is your character associated with olympic events?' => 2,
            'Is your character mainly a player?' => 2,
            'Was your character born in Brazil?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character won national awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
        ]);
    }

    private function anaMariaBraga(): void
    {
        $this->seedCharacter('Ana Maria Braga', [
            [InitialAttribute::SKIN_FAIR, 1.5],
            [InitialAttribute::HAIR_STRAIGHT, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],

            'Does your character have brown skin?' => 1,
            'Does your character work in entertainment?' => 2,
            'Does your character work in television?' => 2,
            'Is your character known in talk shows?' => 2,
            'Is your character known in prime-time shows?' => 1.5,
            'Was your character born in Brazil?' => 2,
            'Is your character warm and friendly?' => 2,
            'Does your character make jokes often?' => 1.5,
            'Does your character like cooking at home?' => 2,
            'Has your character won national awards?' => 1.5,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
        ]);
    }

    private function silvioSantos(): void
    {
        $this->seedCharacter('Silvio Santos', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::HAIR_STRAIGHT, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            [SecondaryAttribute::RELIGION_JEWISH, 2],
            [SecondaryAttribute::RELIGION_IMPORTANT, 1.5],
            [SecondaryAttribute::POLITICAL_CONSERVATIVE, 1.5],

            'Is your character described as white?' => 2,
            'Was your character born in Brazil?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Does your character speak with a strong accent?' => 1.5,
            'Does your character have children?' => 2,
            'Does your character work in entertainment?' => 2,
            'Does your character work in television?' => 2,
            'Is your character known in talk shows?' => 2,
            'Is your character known in prime-time shows?' => 2,
            'Is your character known in reality shows?' => 1.5,
            'Does your character own a company?' => 2,
            'Does your character focus on sales?' => 2,
            'Does your character build global brands?' => 1.5,
            'Does your character manage large teams?' => 2,
            'Is your character warm and friendly?' => 2,
            'Does your character make jokes often?' => 2,
            'Does your character laugh loudly?' => 2,
            'Is your character street-smart?' => 2,
            'Is your character strategic?' => 1.5,
            'Does your character inspire others?' => 2,
            'Does your character lead a team?' => 2,
            'Does your character have followers?' => 2,
            'Does your character live a luxurious lifestyle?' => 2,
            'Does your character have an iconic catchphrase?' => 2,
            'Does your character have a humorous recurring line?' => 2,
            'Does your character have speech style with memorable lines?' => 2,
            'Is your character known for a unique laugh?' => 2,
            'Is your character known for a recognizable voice?' => 2,
            'Is your character known for an unmistakable attitude?' => 2,
            'Is your character known by a famous nickname?' => 2,
            'Is your character known by a nickname used more than real name?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character won industry awards?' => 1.5,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Did your character have national impact?' => 2,
            'Is your character associated with contemporary history?' => 2,
            'Was your character involved in a cultural milestone?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character associated with South America?' => 2,
            'Is your character known for memes?' => 1.5,
            'Is your character associated with polarizing opinions?' => 1,
        ]);
    }
}

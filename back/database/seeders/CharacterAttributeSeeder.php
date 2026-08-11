<?php

namespace Database\Seeders;

use App\Core\Domain\Attributes\Enums\AttributeSubgroup;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CharacterAttributeSeeder extends Seeder
{
    private const REQUIRED_INITIAL_GROUPS = [
        'skin' => [InitialAttribute::SKIN_FAIR, InitialAttribute::SKIN_DARK],
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
        $this->neymar();
        $this->ronaldinhoGaucho();
        $this->romario();
        $this->cristianoRonaldo();
        $this->lionelMessi();
        $this->viniJr();
        $this->mikeTyson();
        $this->muhammadAli();
        $this->virginiaFonseca();
        $this->robertoCarlos();
        $this->caetanoVeloso();
        $this->michaelJackson();
        $this->anitta();
        $this->chicoBuarque();
        $this->getulioVargas();
        $this->jairBolsonaro();
        $this->lula();
        $this->fernandoHenriqueCardoso();
        $this->domPedroII();
        $this->zumbiDosPalmares();
        $this->princesaIsabel();
        $this->napoleaoBonaparte();
        $this->socrates();
        $this->platao();
        $this->nietzsche();
        $this->machadoDeAssis();
        $this->ayrtonSenna();
        $this->rebecaAndrade();
        $this->anaMariaBraga();
        $this->silvioSantos();
    }

    private function seedCharacter(string $characterName, array $attributes, array $signatureQuestion = []): void
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
        $this->seedSignatureQuestion($characterId, $signatureQuestion);
    }

    private function seedSignatureQuestion(int $characterId, array $signatureQuestion): void
    {
        if ($signatureQuestion === []) {
            return;
        }

        DB::table('attributes')->updateOrInsert(
            ['character_id' => $characterId],
            [
                'attribute_subgroup_id' => AttributeSubgroup::SIGNATURE_TRAITS->value,
                'question' => $signatureQuestion['question'],
                'portuguese_question' => $signatureQuestion['portuguese_question'],
                'is_initial_question' => false,
                'is_secondary_question' => false,
                'internal_name' => null,
            ]
        );

        $attributeId = DB::table('attributes')
            ->where('character_id', $characterId)
            ->value('id');

        DB::table('character_attributes')->updateOrInsert(
            [
                'character_id' => $characterId,
                'attribute_id' => $attributeId,
            ],
            [
                'score' => 2,
            ]
        );
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

    private function signature(string $question, string $portugueseQuestion): array
    {
        return [
            'question' => $question,
            'portuguese_question' => $portugueseQuestion,
        ];
    }

    private function pele(): void
    {
        $this->seedCharacter('Pelé', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],

            'Is your character described as black?' => 2,
            'Does your character look lean?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character have football as main identity?' => 2,
            'Is your character mainly a player?' => 2,
            'Has your character won major international awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
        ], $this->signature(
            'Did your character win three FIFA World Cups?',
            'Seu personagem ganhou três Copas do Mundo?'
        ));
    }

    private function muhammadAli(): void
    {
        $this->seedCharacter('Muhammad Ali', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            [SecondaryAttribute::RELIGION_MUSLIM, 2],
            [SecondaryAttribute::RELIGION_IMPORTANT, 2],
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 2],

            'Is your character hair texture coily?' => 2,
            'Is your character American?' => 2,
            'Is your character described as black?' => 2,
            'Does your character look muscular?' => 2,
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
        ], $this->signature(
            'Did your character refuse to be drafted into the Vietnam War?',
            'Seu personagem se recusou a ser convocado para a Guerra do Vietnã?'
        ));
    }

    private function ayrtonSenna(): void
    {
        $this->seedCharacter('Ayrton Senna', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            [SecondaryAttribute::RELIGION_CHRISTIAN, 2],

            'Is your character hair texture straight?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Is your character associated with motorsports?' => 2,
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
        ], $this->signature(
            'Did your character die at the Imola circuit?',
            'Seu personagem morreu no circuito de Imola?'
        ));
    }

    private function rebecaAndrade(): void
    {
        $this->seedCharacter('Rebeca Andrade', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],

            'Is your character described as black?' => 2,
            'Does your character look lean?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Is your character associated with olympic events?' => 2,
            'Is your character mainly a player?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character won national awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
        ], $this->signature(
            'Did your character win Olympic gold in artistic gymnastics for Brazil?',
            'Seu personagem ganhou ouro olímpico em ginástica artística pelo Brasil?'
        ));
    }

    private function anaMariaBraga(): void
    {
        $this->seedCharacter('Ana Maria Braga', [
            [InitialAttribute::SKIN_FAIR, 1.5],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],

            'Is your character hair texture straight?' => 2,
            'Does your character work in entertainment?' => 2,
            'Does your character work mainly in television?' => 2,
            'Is your character known in talk shows?' => 2,
            'Is your character known in prime-time shows?' => 1.5,
            'Is your character warm and friendly?' => 2,
            'Does your character make jokes often?' => 1.5,
            'Does your character like cooking at home?' => 2,
            'Has your character won national awards?' => 1.5,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
        ], $this->signature(
            'Does your character host the TV show Mais Você?',
            'Seu personagem apresenta o programa Mais Você?'
        ));
    }

    private function silvioSantos(): void
    {
        $this->seedCharacter('Silvio Santos', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            [SecondaryAttribute::RELIGION_JEWISH, 2],
            [SecondaryAttribute::POLITICAL_CONSERVATIVE, 1.5],

            'Is your character hair texture straight?' => 2,
            'Is your character described as white?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Does your character speak with a strong accent?' => 1.5,
            'Does your character have children?' => 2,
            'Does your character work in entertainment?' => 2,
            'Does your character work mainly in television?' => 2,
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
        ], $this->signature(
            'Does your character own the SBT television network?',
            'Seu personagem é dono da emissora SBT?'
        ));
    }

    private function neymar(): void
    {
        $this->seedCharacter('Neymar', [
            [InitialAttribute::SKIN_FAIR, 1],
            [InitialAttribute::SKIN_DARK, 1],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            // conteudo digital

            'Does your character look lean?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character play as a forward?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Does your character have football as main identity?' => 2,
            'Is your character mainly a player?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
        ], $this->signature(
            'Did your character join Paris Saint-Germain for a world-record transfer fee?',
            'Seu personagem foi para o Paris Saint-Germain por uma transferência recorde?'
        ));
    }

    private function ronaldinhoGaucho(): void
    {
        $this->seedCharacter('Ronaldinho Gaúcho', [
            [InitialAttribute::SKIN_DARK, 1.5],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character described as black?' => 1,
            'Does your character look lean?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Does your character have football as main identity?' => 2,
            'Is your character mainly a player?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
        ], $this->signature(
            'Did your character win the Ballon d\'Or in 2005?',
            'Seu personagem ganhou a Bola de Ouro em 2005?'
        ));
    }

    private function romario(): void
    {
        $this->seedCharacter('Romário', [
            [InitialAttribute::SKIN_FAIR, 1],
            [InitialAttribute::SKIN_DARK, 1],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character look lean?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character play as a forward?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Does your character have football as main identity?' => 2,
            'Is your character mainly a player?' => 2,
            'Is your character known by world champion title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
        ], $this->signature(
            'Did your character claim to have scored more than one thousand career goals?',
            'Seu personagem afirmou ter marcado mais de mil gols na carreira?'
        ));
    }

    private function cristianoRonaldo(): void
    {
        $this->seedCharacter('Cristiano Ronaldo', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character hair texture straight?' => 2,
            'Does your character look lean?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character play as a forward?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Does your character have football as main identity?' => 2,
            'Is your character mainly a player?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
        ], $this->signature(
            'Is your character famous for a "Siuu" celebration?',
            'Seu personagem é famoso por comemoração "Siuu"?'
        ));
    }

    private function lionelMessi(): void
    {
        $this->seedCharacter('Lionel Messi', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character hair texture straight?' => 2,
            'Does your character look lean?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character play as a forward?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Does your character have football as main identity?' => 2,
            'Is your character mainly a player?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
        ], $this->signature(
            'Did your character win the FIFA World Cup in 2022?',
            'Seu personagem ganhou a Copa do Mundo de 2022?'
        ));
    }

    private function viniJr(): void
    {
        $this->seedCharacter('Vini Jr.', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character hair texture coily?' => 2,
            'Is your character described as black?' => 2,
            'Does your character look lean?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character play as a forward?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Does your character have football as main identity?' => 2,
            'Is your character mainly a player?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
        ], $this->signature(
            'Did your character score in a Champions League final before turning 22?',
            'Seu personagem marcou gol em final da Champions League antes dos 22 anos?'
        ));
    }

    private function mikeTyson(): void
    {
        $this->seedCharacter('Mike Tyson', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::RELIGION_MUSLIM, 1.5],

            'Is your character hair texture coily?' => 2,
            'Is your character American?' => 2,
            'Is your character described as black?' => 2,
            'Does your character look muscular?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character compete in boxing?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Is your character mainly a player?' => 2,
            'Is your character aggressive?' => 2,
            'Is your character known by world champion title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character associated with public scandals?' => 1.5,
        ], $this->signature(
            'Does your character have a facial tattoo?',
            'Seu personagem tem tatuagem no rosto?'
        ));
    }

    private function virginiaFonseca(): void
    {
        $this->seedCharacter('Virgínia Fonseca', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [InitialAttribute::MEDIA_DIGITAL_CONTENT, 2],

            'Is your character hair texture straight?' => 2,
            'Does your character work in entertainment?' => 2,
            'Does your character work mainly in online digital content?' => 2,
            'Does your character work mainly in social platforms?' => 2,
            'Does your character have followers?' => 2,
            'Is your character known for large follower counts?' => 2,
            'Is your character known for short videos?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
        ], $this->signature(
            'Was your character investigated for its involvement with bets?',
            'Seu personagem esteve envolvido na CPI das bets?'
        ));
    }

    private function robertoCarlos(): void
    {
        $this->seedCharacter('Roberto Carlos', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],

            'Is your character hair texture straight?' => 2,
            'Is your character a singer?' => 2,
            'Does your character work in entertainment?' => 2,
            'Is your character active in music?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character known by legend title?' => 1.5,
        ], $this->signature(
            'Is your character famous for a bending free kick against France in 1997?',
            'Seu personagem é famoso por um gol de falta curva contra a França em 1997?'
        ));
    }

    private function caetanoVeloso(): void
    {
        $this->seedCharacter('Caetano Veloso', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 1.5],

            'Is your character a singer?' => 2,
            'Does your character work in entertainment?' => 2,
            'Is your character active in music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character associated with writing as profession?' => 1.5,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have cultural impact?' => 2,
        ], $this->signature(
            'Was your character exiled during Brazil\'s military dictatorship?',
            'Seu personagem foi exilado durante a ditadura militar brasileira?'
        ));
    }

    private function michaelJackson(): void
    {
        $this->seedCharacter('Michael Jackson', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character American?' => 2,
            'Is your character described as black?' => 2,
            'Is your character a singer?' => 2,
            'Does your character work in entertainment?' => 2,
            'Is your character active in music?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Is your character known for award-winning performances?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character known for a specific pose?' => 2,
        ], $this->signature(
            'Did your character release the album Thriller?',
            'Seu personagem lançou o álbum Thriller?'
        ));
    }

    private function anitta(): void
    {
        $this->seedCharacter('Anitta', [
            [InitialAttribute::SKIN_FAIR, 1.5],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [InitialAttribute::MEDIA_DIGITAL_CONTENT, 1.5],

            'Is your character hair texture straight?' => 2,
            'Is your character a singer?' => 2,
            'Does your character work in entertainment?' => 2,
            'Is your character active in music?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Does your character work mainly in online digital content?' => 1.5,
            'Has your character won national awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
        ], $this->signature(
            'Did your character perform at the 2022 FIFA World Cup opening ceremony?',
            'Seu personagem se apresentou na abertura da Copa do Mundo de 2022?'
        ));
    }

    private function chicoBuarque(): void
    {
        $this->seedCharacter('Chico Buarque', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 1.5],

            'Is your character a singer?' => 2,
            'Does your character work in entertainment?' => 2,
            'Is your character active in music?' => 2,
            'Is your character active in literature?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character associated with novels?' => 2,
            'Is your character associated with writing as profession?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Did your character have cultural impact?' => 2,
        ], $this->signature(
            'Did your character write the song Construção?',
            'Seu personagem escreveu a música Construção?'
        ));
    }

    private function getulioVargas(): void
    {
        $this->seedCharacter('Getúlio Vargas', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character hair texture straight?' => 2,
            'Is your character a politician?' => 2,
            'Does your character work in public administration?' => 2,
            'Does your character serve/served in government office?' => 2,
            'Is your character politically active?' => 2,
            'Did your character act as a ruler?' => 2,
            'Did your character have national impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Is your character associated with modern history?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Did your character create the CLT labor laws in Brazil?',
            'Seu personagem criou a CLT no Brasil?'
        ));
    }

    private function jairBolsonaro(): void
    {
        $this->seedCharacter('Jair Bolsonaro', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],
            [SecondaryAttribute::POLITICAL_CONSERVATIVE, 2],

            'Is your character hair texture straight?' => 2,
            'Is your character a politician?' => 2,
            'Does your character work in public administration?' => 2,
            'Does your character serve/served in government office?' => 2,
            'Is your character politically active?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character associated with political controversy?' => 2,
            'Is your character associated with polarizing opinions?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Was your character stabbed during the 2018 presidential campaign?',
            'Seu personagem foi esfaqueado durante a campanha presidencial de 2018?'
        ));
    }

    private function lula(): void
    {
        $this->seedCharacter('Luiz Inácio Lula da Silva', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 2],

            'Is your character hair texture straight?' => 2,
            'Is your character a politician?' => 2,
            'Does your character work in public administration?' => 2,
            'Does your character serve/served in government office?' => 2,
            'Is your character politically active?' => 2,
            'Does your character inspire others?' => 2,
            'Has your character won national awards?' => 1.5,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character associated with political controversy?' => 1.5,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Does your character have nine fingers?',
            'Seu personagem tem 9 dedos?'
        ));
    }

    private function fernandoHenriqueCardoso(): void
    {
        $this->seedCharacter('Fernando Henrique Cardoso', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 1.5],

            'Is your character hair texture straight?' => 2,
            'Is your character a politician?' => 2,
            'Is your character a teacher?' => 1.5,
            'Does your character have a university degree?' => 2,
            'Does your character work in public administration?' => 2,
            'Does your character serve/served in government office?' => 2,
            'Is your character politically active?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received institutional recognition?' => 2,
            'Did your character have national impact?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Did your character implement the Real Plan as president of Brazil?',
            'Seu personagem implementou o Plano Real como presidente do Brasil?'
        ));
    }

    private function domPedroII(): void
    {
        $this->seedCharacter('Dom Pedro II', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character hair texture straight?' => 2,
            'Is your character known as a king or queen?' => 2,
            'Did your character act as a ruler?' => 2,
            'Is your character book-smart?' => 2,
            'Is your character associated with modern history?' => 2,
            'Was your character involved in a political transition?' => 2,
            'Did your character have national impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character associated with South America?' => 2,
        ], $this->signature(
            'Was your character the last emperor of Brazil?',
            'Seu personagem foi o último imperador do Brasil?'
        ));
    }

    private function zumbiDosPalmares(): void
    {
        $this->seedCharacter('Zumbi dos Palmares', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character hair texture coily?' => 2,
            'Is your character described as black?' => 2,
            'Did your character act as a ruler?' => 1.5,
            'Did your character act as a revolutionary?' => 2,
            'Was your character involved in a social movement?' => 2,
            'Is your character associated with modern history?' => 2,
            'Did your character have national impact?' => 2,
            'Did your character have cultural impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Did your character lead the Quilombo dos Palmares?',
            'Seu personagem liderou o Quilombo dos Palmares?'
        ));
    }

    private function princesaIsabel(): void
    {
        $this->seedCharacter('Princesa Isabel', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character hair texture straight?' => 2,
            'Did your character act as a ruler?' => 1.5,
            'Was your character involved in a social movement?' => 2,
            'Was your character involved in a political transition?' => 1.5,
            'Is your character associated with modern history?' => 2,
            'Did your character have national impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Did your character sign the Golden Law abolishing slavery in Brazil?',
            'Seu personagem assinou a Lei Áurea no Brasil?'
        ));
    }

    private function napoleaoBonaparte(): void
    {
        $this->seedCharacter('Napoleão Bonaparte', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character hair texture straight?' => 2,
            'Is your character French?' => 2,
            'Is your character known as a king or queen?' => 1.5,
            'Did your character act as a ruler?' => 2,
            'Did your character act as a military leader?' => 2,
            'Was your character involved in a major war?' => 2,
            'Is your character strategic?' => 2,
            'Is your character associated with modern history?' => 2,
            'Did your character have global impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character associated with Europe?' => 2,
        ], $this->signature(
            'Was your character defeated at the Battle of Waterloo?',
            'Seu personagem foi derrotado na Batalha de Waterloo?'
        ));
    }

    private function socrates(): void
    {
        $this->seedCharacter('Sócrates', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character hair texture straight?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Is your character known for solving complex problems?' => 2,
            'Is your character associated with ancient history?' => 2,
            'Did your character have global impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 1.5,
        ], $this->signature(
            'Did your character die by drinking hemlock?',
            'Seu personagem morreu ao beber cicuta?'
        ));
    }

    private function platao(): void
    {
        $this->seedCharacter('Platão', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character hair texture straight?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Is your character a teacher?' => 2,
            'Is your character known for solving complex problems?' => 2,
            'Is your character associated with ancient history?' => 2,
            'Did your character have global impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
        ], $this->signature(
            'Did your character found the Academy in Athens?',
            'Seu personagem fundou a Academia em Atenas?'
        ));
    }

    private function nietzsche(): void
    {
        $this->seedCharacter('Friedrich Nietzsche', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character hair texture straight?' => 2,
            'Is your character German?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Is your character associated with writing as profession?' => 2,
            'Is your character associated with modern history?' => 2,
            'Did your character have global impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
        ], $this->signature(
            'Did your character write the phrase "God is dead"?',
            'Seu personagem escreveu a frase "Deus está morto"?'
        ));
    }

    private function machadoDeAssis(): void
    {
        $this->seedCharacter('Machado de Assis', [
            [InitialAttribute::SKIN_FAIR, 1.5],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character described as black?' => 1.5,
            'Is your character active in literature?' => 2,
            'Is your character associated with novels?' => 2,
            'Is your character associated with writing as profession?' => 2,
            'Is your character associated with best-selling books?' => 1.5,
            'Is your character book-smart?' => 2,
            'Did your character have national impact?' => 2,
            'Did your character have cultural impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Was your character the first president of the Brazilian Academy of Letters?',
            'Seu personagem foi o primeiro presidente da Academia Brasileira de Letras?'
        ));
    }
}

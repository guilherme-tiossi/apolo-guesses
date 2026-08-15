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
        $this->elisRegina();
        $this->mariliaMendonca();
        $this->fernandaMontenegro();
        $this->marieCurie();
        $this->clariceLispector();
        $this->dilmaRousseff();
        $this->rainhaElizabethII();
        $this->giseleBundchen();
        $this->iveteSangalo();
        $this->brunaMarquezine();
        $this->reginaCase();
        $this->chaves();
        $this->monica();
        $this->homerSimpson();
        $this->mickeyMouse();
        $this->bobEsponja();
        $this->capitaoNascimento();
        $this->zePequeno();
        $this->michaelJordan();
        $this->albertEinstein();
        $this->lewisHamilton();
        $this->rafaelNadal();
        $this->stevenSpielberg();
        $this->elonMusk();
        $this->pabloPicasso();
        $this->conorMcGregor();
        $this->rivaldo();
        $this->oscarSchmidt();
        $this->gabrielMedina();
        $this->jorgeAmado();
        $this->marcosPontes();
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
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Does your character be known for dribbling?' => 2,
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
            'Does your character compete in boxing?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Has your character won major international awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
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
            'Is your character associated with motorsports?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Does your character take command in crisis?' => 2,
            'Does your character inspire others?' => 2,
            'Does your character hold a speed record?' => 2,
            'Does your character hold multiple records?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
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
            'Is your character associated with olympic events?' => 2,
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
            'Is your character known by a famous nickname?' => 2,
            'Is your character known by a nickname used more than real name?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won national awards?' => 2,
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
            'Does your character look lean?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
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
            'Does your character play football professionally?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
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
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
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
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
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
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
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
            'Does your character play football professionally?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
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
            'Does your character compete in boxing?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
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
            'Is your character linked to MPB?' => 2,
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
            'Is your character linked to MPB?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Was your character involved in political exile?' => 2,
            'Has your character won national awards?' => 2,
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
            [InitialAttribute::SKIN_FAIR, 1],
            [InitialAttribute::SKIN_DARK, 1],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character American?' => 2,
            'Is your character described as black?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Is your character known for award-winning performances?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have global impact?' => 2,
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
            'Is your character linked to MPB?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character active in theater?' => 2,
            'Is your character active in literature?' => 2,
            'Is your character associated with novels?' => 2,
            'Was your character involved in political exile?' => 1.5,
            'Has your character won national awards?' => 2,
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
            'Is your character associated with short stories?' => 2,
            'Is your character associated with writing as profession?' => 2,
            'Is your character associated with modern history?' => 2,
            'Is your character book-smart?' => 2,
            'Did your character have national impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Was your character the first president of the Brazilian Academy of Letters?',
            'Seu personagem foi o primeiro presidente da Academia Brasileira de Letras?'
        ));
    }

    private function elisRegina(): void
    {
        $this->seedCharacter('Elis Regina', [
            [InitialAttribute::SKIN_FAIR, 1.5],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character a singer?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to bossa nova?' => 2,
            'Is your character linked to live performances?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Has your character won national awards?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Did your character record the song Arrastão?',
            'Seu personagem gravou a música Arrastão?'
        ));
    }

    private function mariliaMendonca(): void
    {
        $this->seedCharacter('Marília Mendonça', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character a singer?' => 2,
            'Is your character linked to sertanejo music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Was your character one of the main names of sertanejo music?',
            'Seu personagem foi um dos principais nomes do sertanejo?'
        ));
    }

    private function fernandaMontenegro(): void
    {
        $this->seedCharacter('Fernanda Montenegro', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a actor?' => 2,
            'Does your character work in entertainment?' => 2,
            'Is your character known for drama movies?' => 2,
            'Is your character known for award-winning performances?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Is your character known by legend title?' => 2,
        ], $this->signature(
            'Was your character nominated for an Oscar for Central Station?',
            'Seu personagem foi indicada ao Oscar por Central do Brasil?'
        ));
    }

    private function marieCurie(): void
    {
        $this->seedCharacter('Marie Curie', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character French?' => 2,
            'Is your character a scientist?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character associated with Europe?' => 2,
        ], $this->signature(
            'Did your character win two Nobel Prizes?',
            'Seu personagem ganhou dois Prêmios Nobel?'
        ));
    }

    private function clariceLispector(): void
    {
        $this->seedCharacter('Clarice Lispector', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character active in literature?' => 2,
            'Is your character associated with experimental prose?' => 2,
            'Is your character associated with modernist literature?' => 2,
            'Is your character associated with short stories?' => 2,
            'Is your character associated with writing as profession?' => 2,
            'Is your character book-smart?' => 2,
            'Did your character have cultural impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Did your character write The Passion According to G.H.?',
            'Seu personagem escreveu A Paixão Segundo G.H.?'
        ));
    }

    private function dilmaRousseff(): void
    {
        $this->seedCharacter('Dilma Rousseff', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 2],

            'Is your character a politician?' => 2,
            'Does your character work in public administration?' => 2,
            'Does your character serve/served in government office?' => 2,
            'Is your character politically active?' => 2,
            'Is your character associated with controversies?' => 2,
            'Is your character associated with polarizing opinions?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Was your character impeached as president of Brazil?',
            'Seu personagem sofreu impeachment como presidente do Brasil?'
        ));
    }

    private function rainhaElizabethII(): void
    {
        $this->seedCharacter('Rainha Elizabeth II', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character British?' => 2,
            'Is your character known as a king or queen?' => 2,
            'Did your character act as a ruler?' => 2,
            'Did your character have global impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character associated with Europe?' => 2,
        ], $this->signature(
            'Did your character reign for more than 70 years?',
            'Seu personagem reinou por mais de 70 anos?'
        ));
    }

    private function giseleBundchen(): void
    {
        $this->seedCharacter('Gisele Bündchen', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character very tall?' => 2,
            'Does your character look lean?' => 2,
            'Does your character usually wear a elegant style?' => 2,
            'Does your character work in entertainment?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character linked to United States?' => 2,
        ], $this->signature(
            'Was your character one of the highest-paid models in the world?',
            'Seu personagem foi uma das modelos mais bem pagas do mundo?'
        ));
    }

    private function iveteSangalo(): void
    {
        $this->seedCharacter('Ivete Sangalo', [
            [InitialAttribute::SKIN_FAIR, 1.5],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a singer?' => 2,
            'Is your character linked to axé music?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Is your character famous for performing in Carnival in Salvador?',
            'Seu personagem é famosa por se apresentar no Carnaval de Salvador?'
        ));
    }

    private function brunaMarquezine(): void
    {
        $this->seedCharacter('Bruna Marquezine', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [InitialAttribute::MEDIA_DIGITAL_CONTENT, 1.5],

            'Is your character a actor?' => 2,
            'Does your character work in entertainment?' => 2,
            'Is your character known in tv series?' => 2,
            'Does your character work mainly in social platforms?' => 2,
            'Is your character known for large follower counts?' => 2,
            'Has your character received media recognition?' => 2,
        ], $this->signature(
            'Was your character the lead in the novela Deus Salve o Rei?',
            'Seu personagem foi protagonista da novela Deus Salve o Rei?'
        ));
    }

    private function reginaCase(): void
    {
        $this->seedCharacter('Regina Casé', [
            [InitialAttribute::SKIN_FAIR, 1.5],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a actor?' => 2,
            'Does your character work in entertainment?' => 2,
            'Is your character known in tv series?' => 2,
            'Is your character warm and friendly?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Did your character host the TV show Esquenta?',
            'Seu personagem apresentou o programa Esquenta?'
        ));
    }

    private function chaves(): void
    {
        $this->seedCharacter('Chaves', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character speak Spanish?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character warm and friendly?' => 2,
            'Is your character known in tv series?' => 2,
            'Is your character known by a famous nickname?' => 2,
        ], $this->signature(
            'Does your character live in a barrel?',
            'Seu personagem mora em um barril?'
        ));
    }

    private function monica(): void
    {
        $this->seedCharacter('Mônica', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character aggressive?' => 1.5,
            'Is your character known by a famous nickname?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Does your character have super strength in her comics?',
            'Seu personagem tem superforça nos quadrinhos?'
        ));
    }

    private function homerSimpson(): void
    {
        $this->seedCharacter('Homer Simpson', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character look fat?' => 2,
            'Does your character speak English?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character known in tv series?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character known for memes?' => 2,
            'Is your character linked to United States?' => 2,
        ], $this->signature(
            'Does your character work at a nuclear power plant?',
            'Seu personagem trabalha em uma usina nuclear?'
        ));
    }

    private function mickeyMouse(): void
    {
        $this->seedCharacter('Mickey Mouse', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have no hair?' => 2,
            'Is your character primarily a protagonist?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known by a nickname used more than real name?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to United States?' => 2,
        ], $this->signature(
            'Is your character the mascot of Disney?',
            'Seu personagem é o mascote da Disney?'
        ));
    }

    private function bobEsponja(): void
    {
        $this->seedCharacter('Bob Esponja', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character warm and friendly?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character known in tv series?' => 2,
            'Is your character known for memes?' => 2,
        ], $this->signature(
            'Does your character work at the Krusty Krab?',
            'Seu personagem trabalha no Siri Cascudo?'
        ));
    }

    private function capitaoNascimento(): void
    {
        $this->seedCharacter('Capitão Nascimento', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character known for action movies?' => 2,
            'Is your character aggressive?' => 1.5,
            'Does your character take command in crisis?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Did your character say "Operação acabou"?',
            'Seu personagem disse "Operação acabou"?'
        ));
    }

    private function zePequeno(): void
    {
        $this->seedCharacter('Zé Pequeno', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],

            'Is your character described as black?' => 2,
            'Is your character primarily a antagonist?' => 2,
            'Is your character morally gray?' => 2,
            'Is your character aggressive?' => 2,
            'Is your character known for drama movies?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Is your character the villain of City of God?',
            'Seu personagem é o vilão de Cidade de Deus?'
        ));
    }

    private function michaelJordan(): void
    {
        $this->seedCharacter('Michael Jordan', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character American?' => 2,
            'Is your character very tall?' => 2,
            'Does your character look muscular?' => 2,
            'Does your character play basketball professionally?' => 2,
            'Does your character win basketball championships?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received international recognition?' => 2,
        ], $this->signature(
            'Did your character win six NBA championships?',
            'Seu personagem ganhou seis campeonatos da NBA?'
        ));
    }

    private function albertEinstein(): void
    {
        $this->seedCharacter('Albert Einstein', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character German?' => 2,
            'Is your character a scientist?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Has your character won major international awards?' => 2,
            'Did your character have global impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
        ], $this->signature(
            'Did your character develop the theory of relativity?',
            'Seu personagem desenvolveu a teoria da relatividade?'
        ));
    }

    private function lewisHamilton(): void
    {
        $this->seedCharacter('Lewis Hamilton', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character British?' => 2,
            'Is your character described as black?' => 2,
            'Is your character associated with motorsports?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
        ], $this->signature(
            'Has your character won seven Formula 1 world titles?',
            'Seu personagem ganhou sete títulos mundiais de Fórmula 1?'
        ));
    }

    private function rafaelNadal(): void
    {
        $this->seedCharacter('Rafael Nadal', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character speak Spanish?' => 2,
            'Is your character associated with tennis?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Is your character associated with Europe?' => 2,
        ], $this->signature(
            'Has your character won the most French Open titles in history?',
            'Seu personagem venceu o maior número de Roland Garros na história?'
        ));
    }

    private function stevenSpielberg(): void
    {
        $this->seedCharacter('Steven Spielberg', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character American?' => 2,
            'Does your character work in entertainment?' => 2,
            'Is your character active in cinema?' => 2,
            'Is your character known for award-winning performances?' => 2,
            'Has your character won major international awards?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character known by legend title?' => 2,
        ], $this->signature(
            'Did your character direct Jurassic Park?',
            'Seu personagem dirigiu Jurassic Park?'
        ));
    }

    private function elonMusk(): void
    {
        $this->seedCharacter('Elon Musk', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character American?' => 2,
            'Does your character work in technology?' => 2,
            'Does your character own a company?' => 2,
            'Is your character strategic?' => 2,
            'Does your character live a luxurious lifestyle?' => 2,
            'Is your character associated with controversies?' => 2,
            'Is your character associated with polarizing opinions?' => 2,
            'Has your character received media recognition?' => 2,
        ], $this->signature(
            'Is your character the CEO of Tesla?',
            'Seu personagem é CEO da Tesla?'
        ));
    }

    private function pabloPicasso(): void
    {
        $this->seedCharacter('Pablo Picasso', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character speak Spanish?' => 2,
            'Is your character linked to France?' => 2,
            'Is your character impulsive?' => 1.5,
            'Did your character have cultural impact?' => 2,
            'Did your character have global impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character associated with Europe?' => 2,
        ], $this->signature(
            'Did your character co-found the Cubist movement?',
            'Seu personagem cofundou o movimento cubista?'
        ));
    }

    private function conorMcGregor(): void
    {
        $this->seedCharacter('Conor McGregor', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character speak English?' => 2,
            'Does your character compete in mma?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Is your character aggressive?' => 2,
            'Is your character impulsive?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character associated with controversies?' => 2,
            'Has your character received media recognition?' => 2,
        ], $this->signature(
            'Did your character hold UFC titles in two weight classes simultaneously?',
            'Seu personagem foi campeão simultâneo em duas categorias do UFC?'
        ));
    }

    private function rivaldo(): void
    {
        $this->seedCharacter('Rivaldo', [
            [InitialAttribute::SKIN_DARK, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character described as black?' => 2,
            'Does your character look lean?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
        ], $this->signature(
            'Did your character win the Ballon d\'Or in 2002?',
            'Seu personagem ganhou a Bola de Ouro em 2002?'
        ));
    }

    private function oscarSchmidt(): void
    {
        $this->seedCharacter('Oscar Schmidt', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character very tall?' => 2,
            'Does your character play basketball professionally?' => 2,
            'Is your character associated with olympic events?' => 2,
            'Has your character won national awards?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Did your character score 55 points in a single Olympic game?',
            'Seu personagem marcou 55 pontos em um jogo olímpico?'
        ));
    }

    private function gabrielMedina(): void
    {
        $this->seedCharacter('Gabriel Medina', [
            [InitialAttribute::SKIN_FAIR, 1.5],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character look lean?' => 2,
            'Is your character associated with surfing?' => 2,
            'Is your character known by world champion title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Has your character won multiple world surfing titles?',
            'Seu personagem ganhou múltiplos títulos mundiais de surfe?'
        ));
    }

    private function jorgeAmado(): void
    {
        $this->seedCharacter('Jorge Amado', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character active in literature?' => 2,
            'Is your character associated with novels?' => 2,
            'Is your character associated with magical realism?' => 2,
            'Is your character associated with writing as profession?' => 2,
            'Did your character have national impact?' => 2,
            'Did your character have cultural impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Did your character write Dona Flor and Her Two Husbands?',
            'Seu personagem escreveu Dona Flor e Seus Dois Maridos?'
        ));
    }

    private function marcosPontes(): void
    {
        $this->seedCharacter('Marcos Pontes', [
            [InitialAttribute::SKIN_FAIR, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a scientist?' => 2,
            'Does your character have formal military training?' => 2,
            'Is your character analytical?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
        ], $this->signature(
            'Was your character the first Brazilian in space?',
            'Seu personagem foi o primeiro brasileiro no espaço?'
        ));
    }
}

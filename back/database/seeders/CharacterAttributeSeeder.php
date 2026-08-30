<?php

namespace Database\Seeders;

use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use App\Core\Domain\Shared\Enums\CharacterCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CharacterAttributeSeeder extends Seeder
{
    private const REQUIRED_INITIAL_GROUPS = [
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

    /** @var array<string, string> */
    private const NATIONALITY_GEOGRAPHY_PAIRS = [
        'Is your character American?' => 'Is your character linked to United States?',
        'Is your character British?' => 'Is your character linked to United Kingdom?',
        'Is your character French?' => 'Is your character linked to France?',
        'Is your character German?' => 'Is your character linked to Germany?',
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
        $this->diegoMaradona();
        $this->zidane();
        $this->kylianMbappe();
        $this->ronaldoFenomeno();
        $this->kaka();
        $this->zico();
        $this->garrincha();
        $this->cafu();
        $this->marta();
        $this->beckham();
        $this->tysonFury();
        $this->joseAldo();
        $this->andersonSilva();
        $this->khabibNurmagomedov();
        $this->mikeTyson();
        $this->muhammadAli();
        $this->virginiaFonseca();
        $this->robertoCarlos();
        $this->caetanoVeloso();
        $this->tomJobim();
        $this->gilbertoGil();
        $this->raulSeixas();
        $this->cazuza();
        $this->ritaLee();
        $this->galCosta();
        $this->timMaia();
        $this->djavan();
        $this->ludmilla();
        $this->prince();
        $this->davidBowie();
        $this->freddieMercury();
        $this->beyonce();
        $this->taylorSwift();
        $this->madonna();
        $this->rihanna();
        $this->billieEilish();
        $this->arianaGrande();
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
        $this->faustaoSilva();
        $this->galvaoBueno();
        $this->lucianoHuck();
        $this->xuxaMeneghel();
        $this->carlinhosMaia();
        $this->whinderssonNunes();
        $this->felipeNeto();
        $this->casimiroMiguel();
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
        $this->alanTuring();
        $this->bobDylan();
        $this->pinkPantheress();
        $this->joanBaez();
        $this->kateBush();
        $this->frankOcean();
        $this->robertSmith();
        $this->thomYorke();
        $this->grimes();
        $this->bjork();
        $this->lanaDelRey();
        $this->kurtCobain();
        $this->gerardWay();
        $this->harryPotter();
        $this->cleopatra();
        $this->cheGuevara();
        $this->narutoUzumaki();
        $this->batman();
        $this->olavoDeCarvalho();
        $this->superman();
        $this->homemAranha();
        $this->mulherMaravilha();
        $this->hulk();
        $this->homemDeFerro();
        $this->capitaoAmerica();
        $this->thor();
        $this->wolverine();
        $this->deadpool();
        $this->coringa();
        $this->flash();
        $this->aquaman();
        $this->thanos();
        $this->venom();
        $this->darthVader();
        $this->yoda();
        $this->lukeSkywalker();
        $this->patoDonald();
        $this->pernaLonga();
        $this->bugsBunny();
        $this->patolino();
        $this->scoobyDoo();
        $this->patrickEstrela();
        $this->picaPau();
        $this->popeye();
        $this->shrek();
        $this->burro();
        $this->simba();
        $this->elsa();
        $this->moana();
        $this->mulan();
        $this->cinderela();
        $this->brancaDeNeve();
        $this->aladdin();
        $this->genio();
        $this->buzzLightyear();
        $this->woody();
        $this->nemo();
        $this->stitch();
        $this->sasukeUchiha();
        $this->goku();
        $this->vegeta();
        $this->luffy();
        $this->pikachu();
        $this->ashKetchum();
        $this->sailorMoon();
        $this->totoro();
        $this->leviAckerman();
        $this->lightYagami();
        $this->edwardElric();
        $this->kirito();
        $this->saitama();
        $this->deku();
        $this->cebolinha();
        $this->cascao();
        $this->magali();
        $this->chicoBento();
        $this->benji();
        $this->seuMadruga();
        $this->chapolinColorado();
        $this->tioBarnabe();
        $this->mario();
        $this->luigi();
        $this->sonic();
        $this->kirby();
        $this->link();
        $this->crashBandicoot();
        $this->laraCroft();
        $this->masterChief();
        $this->kratos();
        $this->pacMan();
        $this->donkeyKong();
        $this->steve();
        $this->hermioneGranger();
        $this->voldemort();
        $this->jamesBond();
        $this->indianaJones();
        $this->forrestGump();
        $this->jackSparrow();
        $this->rockyBalboa();
        $this->terminator();
        $this->neo();
        $this->gandalf();
        $this->frodo();
        $this->jonSnow();
        $this->walterWhite();
        $this->quico();
        $this->donaFlorinda();
        $this->professorGirafales();
        $this->chiquinha();
        $this->seuBarriga();
        $this->dumbledore();
        $this->snape();
        $this->ronyWeasley();
        $this->hagrid();
        $this->dracoMalfoy();
        $this->dobby();
        $this->siriusBlack();
        $this->aragorn();
        $this->legolas();
        $this->gimli();
        $this->gollum();
        $this->sauron();
        $this->bilbo();
        $this->sam();
        $this->hanSolo();
        $this->princesaLeia();
        $this->chewbacca();
        $this->obiWanKenobi();
        $this->grogu();
        $this->papaLeguas();
        $this->coiote();
        $this->r2d2();
        $this->c3po();
        $this->kyloRen();
        $this->frajola();
        $this->piuPiu();
        $this->taz();
        $this->bartSimpson();
        $this->lisaSimpson();
        $this->margeSimpson();
        $this->dracula();
        $this->pennywise();
        $this->sherlockHolmes();
        $this->loki();
        $this->doutorEstranho();
        $this->arlequina();
        $this->lexLuthor();
        $this->scar();
        $this->maleficent();
        $this->seiya();
        $this->piccolo();
        $this->kakashi();
        $this->zoro();
        $this->princesaPeach();
        $this->bowser();
        $this->emilia();
        $this->saciPerere();
        $this->lebronJames();
        $this->charlesDoBronx();
        $this->popo();
        $this->gustavoKuerten();
        $this->nelsonPiquet();
        $this->italoFerreira();
        $this->daianeDosSantos();
        $this->cesarCielo();
        $this->cleberMachado();
        $this->gaules();
        $this->tancredoNeves();
        $this->domPedroI();
        $this->tiradentes();
        $this->reiCharlesIii();
        $this->duqueDeCaxias();
        $this->sobralPinto();
        $this->papaFrancisco();
        $this->padreMarceloRossi();
        $this->edirMacedo();
        $this->silasMalafaia();
        $this->dalaiLama();
        $this->abilioDiniz();
        $this->luizBarsi();
        $this->warrenBuffett();
        $this->oswaldoCruz();
        $this->steveJobs();
        $this->markZuckerberg();
        $this->billGates();
        $this->drauzioVarella();
        $this->erickJacquin();
        $this->paolaCarosella();
        $this->henriqueFogaca();
        $this->hebeCamargo();
        $this->williamBonner();
        $this->fatimaBernardes();
        $this->joseLuizDatena();
        $this->mauricioMaia();
        $this->wagnerMoura();
        $this->lazaroRamos();
        $this->tonyRamos();
        $this->rodrigoSantoro();
        $this->taisAraujo();
        $this->camilaPitanga();
        $this->zecaPagodinho();
        $this->fernandoMeirelles();
        $this->walterSalles();
        $this->chicoAnysio();
        $this->renatoAragao();
        $this->tirullipa();
        $this->fabioPorchat();
        $this->pauloCoelho();
        $this->carlosDrummondDeAndrade();
        $this->viniciusDeMoraes();
        $this->ceciliaMeireles();
        $this->tarsilaDoAmaral();
        $this->candidoPortinari();
        $this->aleijadinho();
        $this->victorBrecheret();
        $this->sebastiaoSalgado();
        $this->alok();
        $this->vintageCulture();
        $this->adrianaLima();
        $this->oskarMetsavaht();
        $this->davidCopperfield();
        $this->carlinhosDeJesus();
    }


    private function seedCharacter(string $characterName, array $attributes, array $signatureQuestion = []): void
    {
        $characterId = $this->characterId($characterName);
        $categoryId = DB::table('characters')->where('id', $characterId)->value('category_id');
        $category = CharacterCategory::from($categoryId);
        $attributes = $this->ensureNationalityGeographyPairs(
            [$category->questionEn() => 2] + $attributes
        );
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

    private function ensureNationalityGeographyPairs(array $attributes): array
    {
        foreach (self::NATIONALITY_GEOGRAPHY_PAIRS as $nationality => $geography) {
            if (isset($attributes[$nationality]) && !isset($attributes[$geography])) {
                $attributes[$geography] = $attributes[$nationality];
            }
        }

        foreach ($attributes as $key => $value) {
            if (!is_int($key) || !is_array($value) || count($value) !== 2) {
                continue;
            }

            if ($value[0] === InitialAttribute::NATIONALITY_BRAZILIAN) {
                $geography = 'Is your character linked to Brazil?';

                if (!isset($attributes[$geography])) {
                    $attributes[$geography] = $value[1];
                }
            }
        }

        return $attributes;
    }

    private function seedSignatureQuestion(int $characterId, array $signatureQuestion): void
    {
        if ($signatureQuestion === []) {
            return;
        }

        DB::table('attributes')->updateOrInsert(
            ['character_id' => $characterId],
            [
                'category_id' => null,
                'subcategory_id' => null,
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
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            'Does your character have dark skin?' => 2,
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],

            'Is your character described as black?' => 2,
            'Does your character look lean?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Has your character won major international awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 1950s?' => 1.5,
            'Did your character become famous in the 1960s?' => 1.25,
        ], $this->signature(
            'Did your character win three FIFA World Cups?',
            'Seu personagem ganhou três Copas do Mundo?'
        ));
    }

    private function muhammadAli(): void
    {
        $this->seedCharacter('Muhammad Ali', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            'Does your character have dark skin?' => 2,
            [SecondaryAttribute::RELIGION_MUSLIM, 2],
            [SecondaryAttribute::RELIGION_IMPORTANT, 2],
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 2],

            'Is your character hair texture coily?' => 2,
            'Is your character American?' => 2,
            'Is your character described as black?' => 2,
            'Does your character look muscular?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character compete in boxing?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Is your character an activist?' => 2,
            'Has your character won major international awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Does your character inspire others?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 1960s?' => 2,
        ], $this->signature(
            'Did your character refuse to be drafted into the Vietnam War?',
            'Seu personagem se recusou a ser convocado para a Guerra do Vietnã?'
        ));
    }

    private function ayrtonSenna(): void
    {
        $this->seedCharacter('Ayrton Senna', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::RELIGION_CHRISTIAN, 2],

            'Is your character hair texture straight?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
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
            'Did your character have national impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 1980s?' => 1.5,
            'Did your character become famous in the 1990s?' => 1.25,
        ], $this->signature(
            'Did your character die at the Imola circuit?',
            'Seu personagem morreu no circuito de Imola?'
        ));
    }

    private function rebecaAndrade(): void
    {
        $this->seedCharacter('Rebeca Andrade', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            'Does your character have dark skin?' => 2,
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],

            'Is your character described as black?' => 2,
            'Does your character look lean?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character associated with olympic events?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character won national awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 2020s?' => 2,
        ], $this->signature(
            'Did your character win Olympic gold in artistic gymnastics for Brazil?',
            'Seu personagem ganhou ouro olímpico em ginástica artística pelo Brasil?'
        ));
    }

    private function anaMariaBraga(): void
    {
        $this->seedCharacter('Ana Maria Braga', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 1,
            'Does your character have dark skin?' => 1,
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],

            'Is your character hair texture straight?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character known in talk shows?' => 2,
            'Is your character known in prime-time shows?' => 1.5,
            'Is your character warm and friendly?' => 2,
            'Does your character make jokes often?' => 1.5,
            'Does your character like cooking at home?' => 2,
            'Has your character won national awards?' => 1.5,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 1980s?' => 1.25,
        ], $this->signature(
            'Does your character host the TV show Mais Você?',
            'Seu personagem apresenta o programa Mais Você?'
        ));
    }

    private function faustaoSilva(): void
    {
        $this->seedCharacter('Faustão', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],

            'Does your character speak Portuguese?' => 2,
            'Is your character a TV host?' => 2,
            'Is your character known in talk shows?' => 2,
            'Is your character known in prime-time shows?' => 2,
            'Does your character make jokes often?' => 2,
            'Does your character laugh loudly?' => 2,
            'Is your character warm and friendly?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character known by a famous nickname?' => 2,
            'Is your character known for memes?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Does your character look fat?' => 2,
            'Did your character become famous in the 1980s?' => 1.5,
            'Did your character become famous in the 1990s?' => 1.25,
        ], $this->signature(
            'Did your character host the Sunday show Domingão do Faustão?',
            'Seu personagem apresentou o Domingão do Faustão?'
        ));
    }

    private function galvaoBueno(): void
    {
        $this->seedCharacter('Galvão Bueno', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character known in prime-time shows?' => 2,
            'Does your character speak with a strong accent?' => 1.5,
            'Is your character warm and friendly?' => 2,
            'Does your character inspire others?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character known by a famous nickname?' => 2,
            'Is your character known for memes?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 1990s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Is your character famous for shouting "GOAL"?',
            'Seu personagem é famoso por gritar "GOOOL"?'
        ));
    }

    private function lucianoHuck(): void
    {
        $this->seedCharacter('Luciano Huck', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a TV host?' => 2,
            'Is your character known in talk shows?' => 2,
            'Is your character known in prime-time shows?' => 2,
            'Is your character known in reality shows?' => 2,
            'Does your character own a company?' => 1.5,
            'Is your character warm and friendly?' => 2,
            'Does your character make jokes often?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 2010s?' => 1.25,
        ], $this->signature(
            'Did your character host the TV show Caldeirão do Huck?',
            'Seu personagem apresentou o Caldeirão do Huck?'
        ));
    }

    private function xuxaMeneghel(): void
    {
        $this->seedCharacter('Xuxa', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character hair texture straight?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a TV host?' => 2,
            'Is your character known in prime-time shows?' => 2,
            'Is your character warm and friendly?' => 2,
            'Does your character have children?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Did your character have national impact?' => 2,
            'Is your character known by a famous nickname?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character gaúcho?' => 2,
            'Did your character become famous in the 1980s?' => 1.5,
            'Did your character become famous in the 1990s?' => 1.25,
        ], $this->signature(
            'Did your character host the children\'s show Xou da Xuxa?',
            'Seu personagem apresentou o Xou da Xuxa?'
        ));
    }

    private function carlinhosMaia(): void
    {
        $this->seedCharacter('Carlinhos Maia', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Does your character have followers?' => 2,
            'Is your character known for large follower counts?' => 2,
            'Is your character known for short videos?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character warm and friendly?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character known for memes?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2020s?' => 1.25,
        ], $this->signature(
            'Is your character famous for the "Os Roni" comedy sketches?',
            'Seu personagem ficou famoso com os esquetes de comédia "Os Roni"?'
        ));
    }

    private function whinderssonNunes(): void
    {
        $this->seedCharacter('Whindersson Nunes', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 1,
            'Does your character have dark skin?' => 1,
            'Does your character speak Portuguese?' => 2,
            'Does your character have followers?' => 2,
            'Is your character known for large follower counts?' => 2,
            'Is your character known for short videos?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character active in music?' => 1.5,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character associated with controversies?' => 1.5,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2020s?' => 1.25,
        ], $this->signature(
            'Did your character start as a YouTube comedian from Piauí?',
            'Seu personagem começou como comediante no YouTube no Piauí?'
        ));
    }

    private function felipeNeto(): void
    {
        $this->seedCharacter('Felipe Neto', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 1.5],

            'Does your character speak Portuguese?' => 2,
            'Does your character have followers?' => 2,
            'Is your character known for large follower counts?' => 2,
            'Is your character known for short videos?' => 1.25,
            'Does your character make jokes often?' => 2,
            'Is your character associated with controversies?' => 2,
            'Is your character associated with polarizing opinions?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Was your character one of Brazil\'s biggest YouTube creators?',
            'Seu personagem foi um dos maiores criadores do YouTube no Brasil?'
        ));
    }

    private function casimiroMiguel(): void
    {
        $this->seedCharacter('Casimiro', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Does your character have followers?' => 2,
            'Is your character known for large follower counts?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character warm and friendly?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character known for memes?' => 2,
            'Does your character look fat?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 2020s?' => 2,
        ], $this->signature(
            'Is your character famous for live-streaming football watch-alongs?',
            'Seu personagem ficou famoso fazendo lives reagindo a jogos de futebol?'
        ));
    }

    private function silvioSantos(): void
    {
        $this->seedCharacter('Silvio Santos', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::RELIGION_JEWISH, 2],
            [SecondaryAttribute::POLITICAL_CONSERVATIVE, 1.5],

            'Is your character hair texture straight?' => 2,
            'Is your character described as white?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Does your character speak with a strong accent?' => 1.5,
            'Does your character have children?' => 2,
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
            'Is your character carioca?' => 2,
            'Is your character known for memes?' => 1.5,
            'Is your character associated with polarizing opinions?' => 1,
            'Did your character become famous in the 1980s?' => 1.5,
            'Did your character become famous in the 1970s?' => 1.25,
            'Did your character become famous in the 1960s?' => 1.25,
        ], $this->signature(
            'Does your character own the SBT television network?',
            'Seu personagem é dono da emissora SBT?'
        ));
    }

    private function neymar(): void
    {
        $this->seedCharacter('Neymar', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            'Does your character look lean?' => 2,

            'Does your character have fair skin?' => 1,
            'Does your character have dark skin?' => 1,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2020s?' => 1.25,
        ], $this->signature(
            'Did your character join Paris Saint-Germain for a world-record transfer fee?',
            'Seu personagem foi para o Paris Saint-Germain por uma transferência recorde?'
        ));
    }

    private function ronaldinhoGaucho(): void
    {
        $this->seedCharacter('Ronaldinho Gaúcho', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 1,
            'Does your character have dark skin?' => 1,

            'Is your character described as black?' => 1,
            'Does your character look lean?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character gaúcho?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 1990s?' => 1.25,
        ], $this->signature(
            'Did your character win the Ballon d\'Or in 2005?',
            'Seu personagem ganhou a Bola de Ouro em 2005?'
        ));
    }

    private function romario(): void
    {
        $this->seedCharacter('Romário', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character look lean?' => 2,

            'Does your character have fair skin?' => 1,
            'Does your character have dark skin?' => 1,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Did your character claim to have scored more than one thousand career goals?',
            'Seu personagem afirmou ter marcado mais de mil gols na carreira?'
        ));
    }

    private function cristianoRonaldo(): void
    {
        $this->seedCharacter('Cristiano Ronaldo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,

            'Is your character hair texture straight?' => 2,
            'Does your character look lean?' => 2,
            'Does your character look muscular?' => 1.5,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character associated with Europe?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 2010s?' => 1.25,
        ], $this->signature(
            'Is your character famous for a "Siuu" celebration?',
            'Seu personagem é famoso por comemoração "Siuu"?'
        ));
    }

    private function lionelMessi(): void
    {
        $this->seedCharacter('Lionel Messi', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,

            'Is your character hair texture straight?' => 2,
            'Does your character look lean?' => 2,
            'Does your character speak Spanish?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character associated with South America?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 2010s?' => 1.25,
        ], $this->signature(
            'Did your character win the FIFA World Cup in 2022?',
            'Seu personagem ganhou a Copa do Mundo de 2022?'
        ));
    }

    private function viniJr(): void
    {
        $this->seedCharacter('Vini Jr.', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            'Does your character have dark skin?' => 2,

            'Is your character hair texture coily?' => 2,
            'Is your character described as black?' => 2,
            'Does your character look lean?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 2020s?' => 2,
        ], $this->signature(
            'Did your character score in a Champions League final before turning 22?',
            'Seu personagem marcou gol em final da Champions League antes dos 22 anos?'
        ));
    }

    private function diegoMaradona(): void
    {
        $this->seedCharacter('Diego Maradona', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak Spanish?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character associated with controversies?' => 2,
            'Is your character linked to Argentina?' => 2,
            'Is your character associated with South America?' => 2,
            'Did your character become famous in the 1980s?' => 1.5,
            'Did your character become famous in the 1970s?' => 1.25,
        ], $this->signature(
            'Did your character score the "Hand of God" goal?',
            'Seu personagem marcou o gol conhecido como "Mão de Deus"?'
        ));
    }

    private function zidane(): void
    {
        $this->seedCharacter('Zinedine Zidane', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character French?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character associated with Europe?' => 2,
            'Is your character linked to France?' => 2,
            'Did your character become famous in the 1990s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Did your character headbutt an opponent in the 2006 World Cup final?',
            'Seu personagem deu uma cabeçada em um adversário na final da Copa de 2006?'
        ));
    }

    private function kylianMbappe(): void
    {
        $this->seedCharacter('Kylian Mbappé', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have dark skin?' => 2,
            'Is your character described as black?' => 2,
            'Is your character French?' => 2,
            'Does your character look lean?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to France?' => 2,
            'Is your character associated with Europe?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2020s?' => 1.25,
        ], $this->signature(
            'Did your character score a hat-trick in the 2022 World Cup final?',
            'Seu personagem fez um hat-trick na final da Copa de 2022?'
        ));
    }

    private function ronaldoFenomeno(): void
    {
        $this->seedCharacter('Ronaldo Fenômeno', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 1,
            'Does your character have dark skin?' => 1,
            'Does your character look lean?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 1990s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Did your character score both goals in the 2002 World Cup final?',
            'Seu personagem marcou os dois gols na final da Copa de 2002?'
        ));
    }

    private function kaka(): void
    {
        $this->seedCharacter('Kaká', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::RELIGION_CHRISTIAN, 2],

            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Did your character win the Ballon d\'Or in 2007?',
            'Seu personagem ganhou a Bola de Ouro em 2007?'
        ));
    }

    private function zico(): void
    {
        $this->seedCharacter('Zico', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 1.5,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 1970s?' => 1.5,
            'Did your character become famous in the 1980s?' => 1.25,
        ], $this->signature(
            'Was your character the main star of Flamengo in the early 1980s?',
            'Seu personagem foi a principal estrela do Flamengo no início dos anos 1980?'
        ));
    }

    private function garrincha(): void
    {
        $this->seedCharacter('Garrincha', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have dark skin?' => 2,
            'Is your character described as black?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have national impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 1950s?' => 1.5,
            'Did your character become famous in the 1960s?' => 1.25,
        ], $this->signature(
            'Did your character win the 1962 World Cup as Brazil\'s standout player?',
            'Seu personagem foi destaque do Brasil na Copa de 1962?'
        ));
    }

    private function cafu(): void
    {
        $this->seedCharacter('Cafu', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have dark skin?' => 2,
            'Is your character described as black?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 1990s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Did your character captain Brazil to the 2002 World Cup title?',
            'Seu personagem capitaneou o Brasil no título da Copa de 2002?'
        ));
    }

    private function marta(): void
    {
        $this->seedCharacter('Marta', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 1,
            'Does your character have dark skin?' => 1,
            'Does your character look lean?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 1.5,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 2010s?' => 1.25,
        ], $this->signature(
            'Has your character won the FIFA World Player of the Year award six times?',
            'Seu personagem ganhou seis vezes o prêmio FIFA de melhor jogadora do mundo?'
        ));
    }

    private function beckham(): void
    {
        $this->seedCharacter('David Beckham', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character British?' => 2,
            'Does your character speak English?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to United Kingdom?' => 2,
            'Is your character associated with Europe?' => 2,
            'Did your character become famous in the 1990s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Is your character famous for bending free kicks?',
            'Seu personagem é famoso por cobranças de falta com efeito?'
        ));
    }

    private function tysonFury(): void
    {
        $this->seedCharacter('Tyson Fury', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character British?' => 2,
            'Does your character speak English?' => 2,
            'Is your character very tall?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character compete in boxing?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character associated with controversies?' => 1.5,
            'Is your character linked to United Kingdom?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2020s?' => 1.25,
        ], $this->signature(
            'Is your character known as the Gypsy King?',
            'Seu personagem é conhecido como o Gypsy King?'
        ));
    }

    private function joseAldo(): void
    {
        $this->seedCharacter('José Aldo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have dark skin?' => 2,
            'Is your character described as black?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character compete in mma?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Was your character the first UFC featherweight champion?',
            'Seu personagem foi o primeiro campeão peso-pena do UFC?'
        ));
    }

    private function andersonSilva(): void
    {
        $this->seedCharacter('Anderson Silva', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have dark skin?' => 2,
            'Is your character described as black?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character compete in mma?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 2010s?' => 1.25,
        ], $this->signature(
            'Is your character known by the nickname Spider?',
            'Seu personagem é conhecido pelo apelido Spider?'
        ));
    }

    private function khabibNurmagomedov(): void
    {
        $this->seedCharacter('Khabib Nurmagomedov', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::RELIGION_MUSLIM, 2],

            'Is your character a athlete?' => 2,
            'Does your character compete in mma?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Is your character associated with Europe?' => 2,
            'Is your character associated with Asia?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2020s?' => 1.25,
        ], $this->signature(
            'Did your character retire undefeated with a 29-0 record?',
            'Seu personagem se aposentou invicto com 29 vitórias e 0 derrotas?'
        ));
    }

    private function mikeTyson(): void
    {
        $this->seedCharacter('Mike Tyson', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            'Does your character have dark skin?' => 2,
            [SecondaryAttribute::RELIGION_MUSLIM, 1.5],

            'Is your character hair texture coily?' => 2,
            'Is your character American?' => 2,
            'Is your character described as black?' => 2,
            'Does your character look muscular?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character compete in boxing?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Is your character aggressive?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character associated with public scandals?' => 1.5,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Does your character have a facial tattoo?',
            'Seu personagem tem tatuagem no rosto?'
        ));
    }

    private function virginiaFonseca(): void
    {
        $this->seedCharacter('Virgínia Fonseca', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,

            'Is your character hair texture straight?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Does your character have followers?' => 2,
            'Is your character known for large follower counts?' => 2,
            'Is your character known for short videos?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character associated with controversies?' => 1.5,
            'Is your character American?' => 1.5,
            'Is your character linked to Brazil?' => 2,
            'Is your character linked to United States?' => 1.5,
            'Did your character become famous in the 2010s?' => 1.25,
            'Did your character become famous in the 2020s?' => 1.5,
        ], $this->signature(
            'Was your character investigated for its involvement with bets?',
            'Seu personagem esteve envolvido na CPI das bets?'
        ));
    }

    private function robertoCarlos(): void
    {
        $this->seedCharacter('Roberto Carlos', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],

            'Is your character hair texture straight?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character known by legend title?' => 1.5,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 1960s?' => 1.5,
            'Did your character become famous in the 1970s?' => 1.25,
        ], $this->signature(
            'Did your character record the song Detalhes?',
            'Seu personagem gravou a música Detalhes?'
        ));
    }

    private function caetanoVeloso(): void
    {
        $this->seedCharacter('Caetano Veloso', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 1.5],

            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to bossa nova?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character book-smart?' => 2,
            'Was your character involved in political exile?' => 2,
            'Was your character involved in a cultural milestone?' => 2,
            'Is your character baiano?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 1960s?' => 1.5,
            'Did your character become famous in the 1970s?' => 1.25,
        ], $this->signature(
            'Did your character compose the song Leãozinho?',
            'Seu personagem compôs a música Leãozinho?'
        ));
    }

    private function tomJobim(): void
    {
        $this->seedCharacter('Tom Jobim', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to bossa nova?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 1960s?' => 1.5,
            'Did your character become famous in the 1950s?' => 1.25,
        ], $this->signature(
            'Did your character compose the song Garota de Ipanema?',
            'Seu personagem compôs a música Garota de Ipanema?'
        ));
    }

    private function gilbertoGil(): void
    {
        $this->seedCharacter('Gilberto Gil', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 2],

            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to bossa nova?' => 1.5,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Was your character involved in political exile?' => 2,
            'Was your character involved in a cultural milestone?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character baiano?' => 2,
            'Did your character become famous in the 1960s?' => 1.5,
            'Did your character become famous in the 1970s?' => 1.25,
        ], $this->signature(
            'Did your character serve as Brazil\'s Minister of Culture?',
            'Seu personagem foi ministro da Cultura do Brasil?'
        ));
    }

    private function raulSeixas(): void
    {
        $this->seedCharacter('Raul Seixas', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character impulsive?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 1970s?' => 1.5,
            'Did your character become famous in the 1980s?' => 1.25,
        ], $this->signature(
            'Did your character record the song Maluco Beleza?',
            'Seu personagem gravou a música Maluco Beleza?'
        ));
    }

    private function cazuza(): void
    {
        $this->seedCharacter('Cazuza', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Is your character impulsive?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Was your character the lead singer of Barão Vermelho?',
            'Seu personagem foi vocalista do Barão Vermelho?'
        ));
    }

    private function ritaLee(): void
    {
        $this->seedCharacter('Rita Lee', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character impulsive?' => 2,
            'Was your character involved in a cultural milestone?' => 2,
            'Has your character won national awards?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 1960s?' => 1.5,
            'Did your character become famous in the 1970s?' => 1.25,
        ], $this->signature(
            'Was your character a member of Os Mutantes?',
            'Seu personagem foi integrante dos Mutantes?'
        ));
    }

    private function galCosta(): void
    {
        $this->seedCharacter('Gal Costa', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to bossa nova?' => 1.5,
            'Is your character linked to live performances?' => 2,
            'Was your character involved in a cultural milestone?' => 2,
            'Has your character won national awards?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character baiano?' => 2,
            'Did your character become famous in the 1960s?' => 1.5,
            'Did your character become famous in the 1970s?' => 1.25,
        ], $this->signature(
            'Did your character record the song Festa do Interior?',
            'Seu personagem gravou a música Festa do Interior?'
        ));
    }

    private function timMaia(): void
    {
        $this->seedCharacter('Tim Maia', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have dark skin?' => 2,
            'Is your character described as black?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character impulsive?' => 2,
            'Is your character associated with public scandals?' => 1.5,
            'Is your character known by legend title?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 1970s?' => 1.5,
            'Did your character become famous in the 1980s?' => 1.25,
        ], $this->signature(
            'Did your character record the song Descobridor dos Sete Mares?',
            'Seu personagem gravou a música Descobridor dos Sete Mares?'
        ));
    }

    private function djavan(): void
    {
        $this->seedCharacter('Djavan', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have dark skin?' => 2,
            'Is your character described as black?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 1970s?' => 1.5,
            'Did your character become famous in the 1980s?' => 1.25,
        ], $this->signature(
            'Did your character compose the song Oceano?',
            'Seu personagem compôs a música Oceano?'
        ));
    }

    private function ludmilla(): void
    {
        $this->seedCharacter('Ludmilla', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have dark skin?' => 2,
            'Is your character described as black?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to hip hop music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2020s?' => 1.25,
        ], $this->signature(
            'Did your character release the album Numanice?',
            'Seu personagem lançou o álbum Numanice?'
        ));
    }

    private function prince(): void
    {
        $this->seedCharacter('Prince', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 1,
            'Does your character have dark skin?' => 1,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to R&B music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 1980s?' => 1.5,
            'Did your character become famous in the 1990s?' => 1.25,
        ], $this->signature(
            'Did your character release the album Purple Rain?',
            'Seu personagem lançou o álbum Purple Rain?'
        ));
    }

    private function davidBowie(): void
    {
        $this->seedCharacter('David Bowie', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            'Is your character British?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character an actor?' => 1.5,
            'Is your character impulsive?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to United Kingdom?' => 2,
            'Did your character become famous in the 1970s?' => 1.5,
            'Did your character become famous in the 1980s?' => 1.25,
        ], $this->signature(
            'Did your character create the alter ego Ziggy Stardust?',
            'Seu personagem criou o alter ego Ziggy Stardust?'
        ));
    }

    private function freddieMercury(): void
    {
        $this->seedCharacter('Freddie Mercury', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            'Is your character British?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Does your character inspire others?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to United Kingdom?' => 2,
            'Did your character become famous in the 1970s?' => 1.5,
            'Did your character become famous in the 1980s?' => 1.25,
        ], $this->signature(
            'Was your character the lead singer of Queen?',
            'Seu personagem foi o vocalista do Queen?'
        ));
    }

    private function beyonce(): void
    {
        $this->seedCharacter('Beyoncé', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have dark skin?' => 2,
            'Is your character described as black?' => 2,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to R&B music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Is your character known for award-winning performances?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 2010s?' => 1.25,
        ], $this->signature(
            'Was your character the lead singer of Destiny\'s Child?',
            'Seu personagem foi vocalista do Destiny\'s Child?'
        ));
    }

    private function taylorSwift(): void
    {
        $this->seedCharacter('Taylor Swift', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to folk music?' => 1.5,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Did your character release the album 1989?',
            'Seu personagem lançou o álbum 1989?'
        ));
    }

    private function madonna(): void
    {
        $this->seedCharacter('Madonna', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Is your character an actor?' => 1.5,
            'Is your character impulsive?' => 2,
            'Is your character known for award-winning performances?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 1980s?' => 1.5,
            'Did your character become famous in the 1990s?' => 1.25,
        ], $this->signature(
            'Is your character known as the Queen of Pop?',
            'Seu personagem é conhecido como a Rainha do Pop?'
        ));
    }

    private function rihanna(): void
    {
        $this->seedCharacter('Rihanna', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have dark skin?' => 2,
            'Is your character described as black?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to R&B music?' => 2,
            'Is your character linked to hip hop music?' => 1.5,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 2010s?' => 1.25,
        ], $this->signature(
            'Did your character release the song Umbrella?',
            'Seu personagem lançou a música Umbrella?'
        ));
    }

    private function billieEilish(): void
    {
        $this->seedCharacter('Billie Eilish', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to indie music?' => 2,
            'Is your character linked to electronic music?' => 1.5,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2020s?' => 1.25,
        ], $this->signature(
            'Did your character release the album When We All Fall Asleep, Where Do We Go?',
            'Seu personagem lançou o álbum When We All Fall Asleep, Where Do We Go?'
        ));
    }

    private function arianaGrande(): void
    {
        $this->seedCharacter('Ariana Grande', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to R&B music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Is your character known in tv series?' => 1.5,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2020s?' => 1.25,
        ], $this->signature(
            'Did your character star in the TV series Victorious?',
            'Seu personagem protagonizou a série Victorious?'
        ));
    }

    private function michaelJackson(): void
    {
        $this->seedCharacter('Michael Jackson', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 0.5,
            'Does your character have dark skin?' => 1.5,

            'Is your character American?' => 2,
            'Is your character described as black?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Is your character known for award-winning performances?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Did your character become famous in the 1980s?' => 1.5,
            'Did your character become famous in the 1970s?' => 1.25,
        ], $this->signature(
            'Did your character release the album Thriller?',
            'Seu personagem lançou o álbum Thriller?'
        ));
    }

    private function anitta(): void
    {
        $this->seedCharacter('Anitta', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 1,
            'Does your character have dark skin?' => 1,

            'Is your character hair texture straight?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2020s?' => 1.25,
        ], $this->signature(
            'Is your character known for changing its appearance frequently?',
            'Sua personagem é conhecida por mudar de rosto com frequência?'
        ));
    }

    private function chicoBuarque(): void
    {
        $this->seedCharacter('Chico Buarque', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 1.5],

            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character active in theater?' => 2,
            'Is your character active in literature?' => 2,
            'Is your character associated with novels?' => 2,
            'Is your character associated with writing as profession?' => 2,
            'Is your character carioca?' => 2,
            'Is your character book-smart?' => 2,
            'Was your character involved in political exile?' => 1.5,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 1960s?' => 1.5,
            'Did your character become famous in the 1970s?' => 1.25,
        ], $this->signature(
            'Did your character write the song Construção?',
            'Seu personagem escreveu a música Construção?'
        ));
    }

    private function getulioVargas(): void
    {
        $this->seedCharacter('Getúlio Vargas', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

            'Is your character hair texture straight?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a politician?' => 2,
            'Is your character known as a president?' => 2,
            'Does your character serve/served in government office?' => 2,
            'Is your character politically active?' => 2,
            'Did your character act as a ruler?' => 2,
            'Did your character have national impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Is your character associated with modern history?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character gaúcho?' => 2,
            'Did your character become famous in the 1930s?' => 2,
        ], $this->signature(
            'Did your character create the CLT labor laws in Brazil?',
            'Seu personagem criou a CLT no Brasil?'
        ));
    }

    private function jairBolsonaro(): void
    {
        $this->seedCharacter('Jair Bolsonaro', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],
            [SecondaryAttribute::POLITICAL_CONSERVATIVE, 2],

            'Is your character hair texture straight?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a politician?' => 2,
            'Is your character known as a president?' => 2,
            'Does your character serve/served in government office?' => 2,
            'Is your character politically active?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character associated with polarizing opinions?' => 2,
            'Is your character associated with controversies?' => 1.5,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Was your character stabbed during the 2018 presidential campaign?',
            'Seu personagem foi esfaqueado durante a campanha presidencial de 2018?'
        ));
    }

    private function lula(): void
    {
        $this->seedCharacter('Luiz Inácio Lula da Silva', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 2],

            'Is your character hair texture straight?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a politician?' => 2,
            'Is your character known as a president?' => 2,
            'Does your character serve/served in government office?' => 2,
            'Is your character politically active?' => 2,
            'Is your character an activist?' => 1.5,
            'Does your character inspire others?' => 2,
            'Did your character have national impact?' => 2,
            'Has your character won national awards?' => 1.5,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 1980s?' => 1.25,
        ], $this->signature(
            'Does your character have nine fingers?',
            'Seu personagem tem 9 dedos?'
        ));
    }

    private function fernandoHenriqueCardoso(): void
    {
        $this->seedCharacter('Fernando Henrique Cardoso', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 1.5],

            'Is your character hair texture straight?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a politician?' => 2,
            'Is your character known as a president?' => 2,
            'Is your character a teacher?' => 1.5,
            'Does your character have a university degree?' => 2,
            'Does your character serve/served in government office?' => 2,
            'Is your character politically active?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Was your character involved in a political transition?' => 2,
            'Has your character received public recognition?' => 2,
            'Did your character have national impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Did your character implement the Real Plan as president of Brazil?',
            'Seu personagem implementou o Plano Real como presidente do Brasil?'
        ));
    }

    private function domPedroII(): void
    {
        $this->seedCharacter('Dom Pedro II', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

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
            'Is your character carioca?' => 2,
        ], $this->signature(
            'Was your character the last emperor of Brazil?',
            'Seu personagem foi o último imperador do Brasil?'
        ));
    }

    private function zumbiDosPalmares(): void
    {
        $this->seedCharacter('Zumbi dos Palmares', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            'Does your character have dark skin?' => 2,

            'Is your character hair texture coily?' => 2,
            'Is your character described as black?' => 2,
            'Is your character an activist?' => 1.5,
            'Did your character act as a ruler?' => 1.5,
            'Did your character act as a revolutionary?' => 2,
            'Was your character involved in a social movement?' => 2,
            'Is your character associated with modern history?' => 2,
            'Did your character have national impact?' => 2,
            'Did your character have cultural impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character associated with South America?' => 2,
        ], $this->signature(
            'Did your character lead the Quilombo dos Palmares?',
            'Seu personagem liderou o Quilombo dos Palmares?'
        ));
    }

    private function princesaIsabel(): void
    {
        $this->seedCharacter('Princesa Isabel', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

            'Is your character hair texture straight?' => 2,
            'Is your character known as a king or queen?' => 1.5,
            'Did your character act as a ruler?' => 1.5,
            'Was your character involved in a social movement?' => 2,
            'Was your character involved in a political transition?' => 1.5,
            'Is your character associated with modern history?' => 2,
            'Did your character have national impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character associated with South America?' => 2,
            'Is your character carioca?' => 2,
        ], $this->signature(
            'Did your character sign the Golden Law abolishing slavery in Brazil?',
            'Seu personagem assinou a Lei Áurea no Brasil?'
        ));
    }

    private function napoleaoBonaparte(): void
    {
        $this->seedCharacter('Napoleão Bonaparte', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

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
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

            'Is your character hair texture straight?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Is your character a teacher?' => 2,
            'Is your character associated with ancient history?' => 2,
            'Is your character associated with Europe?' => 1.5,
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
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

            'Is your character hair texture straight?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Is your character a teacher?' => 2,
            'Is your character associated with writing as profession?' => 1.5,
            'Is your character associated with ancient history?' => 2,
            'Is your character associated with Europe?' => 1.5,
            'Did your character have global impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 1.5,
        ], $this->signature(
            'Did your character found the Academy in Athens?',
            'Seu personagem fundou a Academia em Atenas?'
        ));
    }

    private function nietzsche(): void
    {
        $this->seedCharacter('Friedrich Nietzsche', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

            'Is your character hair texture straight?' => 2,
            'Is your character German?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Is your character active in literature?' => 1.5,
            'Is your character associated with writing as profession?' => 2,
            'Is your character associated with modern history?' => 2,
            'Is your character associated with Europe?' => 2,
            'Is your character linked to Germany?' => 2,
            'Did your character have global impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Did your character have cultural impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
        ], $this->signature(
            'Did your character write the phrase "God is dead"?',
            'Seu personagem escreveu a frase "Deus está morto"?'
        ));
    }

    private function machadoDeAssis(): void
    {
        $this->seedCharacter('Machado de Assis', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 1,
            'Does your character have dark skin?' => 1,

            'Is your character described as black?' => 1.5,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in literature?' => 2,
            'Is your character associated with novels?' => 2,
            'Is your character associated with short stories?' => 2,
            'Is your character associated with writing as profession?' => 2,
            'Is your character associated with modern history?' => 2,
            'Is your character book-smart?' => 2,
            'Did your character have national impact?' => 2,
            'Did your character have cultural impact?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
        ], $this->signature(
            'Was your character the first president of the Brazilian Academy of Letters?',
            'Seu personagem foi o primeiro presidente da Academia Brasileira de Letras?'
        ));
    }

    private function elisRegina(): void
    {
        $this->seedCharacter('Elis Regina', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

            'Is your character a singer?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character linked to MPB?' => 2,
            'Is your character linked to bossa nova?' => 2,
            'Is your character linked to live performances?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Has your character won national awards?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character gaúcho?' => 2,
            'Did your character become famous in the 1960s?' => 1.5,
            'Did your character become famous in the 1970s?' => 1.25,
        ], $this->signature(
            'Did your character record the song Arrastão?',
            'Seu personagem gravou a música Arrastão?'
        ));
    }

    private function mariliaMendonca(): void
    {
        $this->seedCharacter('Marília Mendonça', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

            'Is your character a singer?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character linked to sertanejo music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Was your character known for writing the song "Infiel"?',
            'Seu personagem escreveu a música "Infiel"'
        ));
    }

    private function fernandaMontenegro(): void
    {
        $this->seedCharacter('Fernanda Montenegro', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character speak Portuguese?' => 2,

            'Does your character have fair skin?' => 2,
            'Is your character an actor?' => 2,
            'Is your character active in cinema?' => 2,
            'Is your character known for drama movies?' => 2,
            'Is your character known for award-winning performances?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Was your character nominated for an Oscar for Central Station?',
            'Seu personagem foi indicada ao Oscar por Central do Brasil?'
        ));
    }

    private function marieCurie(): void
    {
        $this->seedCharacter('Marie Curie', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

            'Is your character French?' => 2,
            'Is your character a scientist?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Is your character linked to France?' => 2,
            'Is your character associated with Europe?' => 2,
            'Did your character become famous in the 1900s?' => 2,
        ], $this->signature(
            'Did your character win two Nobel Prizes?',
            'Seu personagem ganhou dois Prêmios Nobel?'
        ));
    }

    private function clariceLispector(): void
    {
        $this->seedCharacter('Clarice Lispector', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character speak Portuguese?' => 2,

            'Does your character have fair skin?' => 2,
            'Is your character active in literature?' => 2,
            'Is your character associated with experimental prose?' => 2,
            'Is your character associated with modernist literature?' => 2,
            'Is your character associated with short stories?' => 2,
            'Is your character associated with writing as profession?' => 2,
            'Is your character book-smart?' => 2,
            'Did your character have cultural impact?' => 2,
            'Did your character have national impact?' => 1.5,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 1960s?' => 2,
        ], $this->signature(
            'Did your character write The Passion According to G.H.?',
            'Seu personagem escreveu A Paixão Segundo G.H.?'
        ));
    }

    private function dilmaRousseff(): void
    {
        $this->seedCharacter('Dilma Rousseff', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 2],

            'Does your character speak Portuguese?' => 2,
            'Is your character a politician?' => 2,
            'Is your character known as a president?' => 2,
            'Does your character serve/served in government office?' => 2,
            'Is your character politically active?' => 2,
            'Does your character have formal military training?' => 1.5,
            'Was your character involved in a political transition?' => 2,
            'Is your character associated with controversies?' => 2,
            'Is your character associated with polarizing opinions?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Was your character impeached as president of Brazil?',
            'Seu personagem sofreu impeachment como presidente do Brasil?'
        ));
    }

    private function rainhaElizabethII(): void
    {
        $this->seedCharacter('Rainha Elizabeth II', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

            'Is your character British?' => 2,
            'Is your character known as a king or queen?' => 2,
            'Did your character act as a ruler?' => 2,
            'Does your character serve/served in government office?' => 1.5,
            'Is your character associated with contemporary history?' => 2,
            'Is your character associated with modern history?' => 2,
            'Did your character have global impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character associated with Europe?' => 2,
            'Did your character become famous in the 1950s?' => 2,
        ], $this->signature(
            'Did your character reign for more than 70 years?',
            'Seu personagem reinou por mais de 70 anos?'
        ));
    }

    private function giseleBundchen(): void
    {
        $this->seedCharacter('Gisele Bündchen', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,

            'Is your character very tall?' => 2,
            'Does your character look lean?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Does your character speak English?' => 2,
            'Does your character usually wear a elegant style?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Did your character have global impact?' => 1.5,
            'Is your character linked to Brazil?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character gaúcho?' => 2,
            'Did your character become famous in the 1990s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Was your character one of the highest-paid models in the world?',
            'Seu personagem foi uma das modelos mais bem pagas do mundo?'
        ));
    }

    private function iveteSangalo(): void
    {
        $this->seedCharacter('Ivete Sangalo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],


            'Is your character a singer?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character active in music?' => 2,
            'Is your character linked to axé music?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to chart-topping songs?' => 1.5,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character baiano?' => 2,
            'Did your character become famous in the 1990s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Is your character famous for performing in Carnival in Salvador?',
            'Seu personagem é famosa por se apresentar no Carnaval de Salvador?'
        ));
    }

    private function brunaMarquezine(): void
    {
        $this->seedCharacter('Bruna Marquezine', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character speak Portuguese?' => 2,

            'Does your character have fair skin?' => 2,
            'Is your character an actor?' => 2,
            'Is your character active in cinema?' => 1.5,
            'Is your character known in tv series?' => 2,
            'Is your character known for large follower counts?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Was your character the lead in the novela Deus Salve o Rei?',
            'Seu personagem foi protagonista da novela Deus Salve o Rei?'
        ));
    }

    private function reginaCase(): void
    {
        $this->seedCharacter('Regina Casé', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character speak Portuguese?' => 2,

            'Does your character have fair skin?' => 1,
            'Does your character have dark skin?' => 1,
            'Is your character an actor?' => 2,
            'Is your character known in tv series?' => 2,
            'Is your character known in prime-time shows?' => 1.5,
            'Is your character warm and friendly?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 2010s?' => 1.25,
        ], $this->signature(
            'Did your character host the TV show Esquenta?',
            'Seu personagem apresentou o programa Esquenta?'
        ));
    }

    private function chaves(): void
    {
        $this->seedCharacter('Chaves', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character speak Spanish?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,

            'Does your character have fair skin?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character warm and friendly?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character known in tv series?' => 2,
            'Is your character known by a famous nickname?' => 2,
            'Is your character associated with South America?' => 1.5,
            'Did your character become famous in the 1970s?' => 2,
            'Does your character appear in slapstick humor?' => 2,
        ], $this->signature(
            'Does your character live in a barrel?',
            'Seu personagem mora em um barril?'
        ));
    }

    private function monica(): void
    {
        $this->seedCharacter('Mônica', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,

            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character warm and friendly?' => 2,
            'Is your character aggressive?' => 1.5,
            'Is your character known in tv series?' => 2,
            'Is your character known by a famous nickname?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 1960s?' => 2,
            'Is your character from Turma da Mônica?' => 2,
        ], $this->signature(
            'Does your character have big teeth?',
            'Seu personagem é dentuço?'
        ));
    }

    private function homerSimpson(): void
    {
        $this->seedCharacter('Homer Simpson', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character look fat?' => 2,
            'Does your character speak English?' => 2,
            'Is your character from an animated show or movie?' => 2,
            'Is your character from a comedy?' => 2,
            'Does your character have fair skin?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character known in tv series?' => 2,
            'Does your character make jokes often?' => 2,
            'Does your character laugh loudly?' => 1.5,
            'Is your character known for memes?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character associated with North America?' => 2,
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Does your character work at a nuclear power plant?',
            'Seu personagem trabalha em uma usina nuclear?'
        ));
    }

    private function mickeyMouse(): void
    {
        $this->seedCharacter('Mickey Mouse', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have no hair?' => 2,
            'Is your character from an animated show or movie?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character primarily a protagonist?' => 2,

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character warm and friendly?' => 2,
            'Is your character known in tv series?' => 2,
            'Is your character known by a nickname used more than real name?' => 2,
            'Did your character have global impact?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character associated with North America?' => 2,
            'Did your character become famous in the 1920s?' => 2,
            'Is your character anthropomorphic?' => 2,
            'Is your character associated with an animal?' => 2,
                    'Is your character from Disney?' => 2,
        ], $this->signature(
            'Is your character the mascot of Disney?',
            'Seu personagem é o mascote da Disney?'
        ));
    }

    private function bobEsponja(): void
    {
        $this->seedCharacter('Bob Esponja', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character speak English?' => 2,
            'Is your character from an animated show or movie?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character primarily a protagonist?' => 2,

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character warm and friendly?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character known in tv series?' => 2,
            'Is your character known for memes?' => 2,
            'Did your character have global impact?' => 1.5,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 1990s?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Does your character work at the Krusty Krab?',
            'Seu personagem trabalha no Siri Cascudo?'
        ));
    }

    private function capitaoNascimento(): void
    {
        $this->seedCharacter('Capitão Nascimento', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],

            'Is your character an actor?' => 2,
            'Is your character active in cinema?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character known for action movies?' => 2,
            'Is your character aggressive?' => 1.5,
            'Does your character take command in crisis?' => 2,
            'Does your character have formal military training?' => 1.5,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Did your character say "Senta o dedo nessa porra"?',
            'Seu personagem disse "Senta o dedo nessa porra"?'
        ));
    }

    private function zePequeno(): void
    {
        $this->seedCharacter('Zé Pequeno', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            'Does your character have dark skin?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],

            'Is your character described as black?' => 2,
            'Is your character an actor?' => 2,
            'Is your character active in cinema?' => 2,
            'Is your character primarily an antagonist?' => 2,
            'Is your character morally gray?' => 2,
            'Is your character aggressive?' => 2,
            'Is your character known for drama movies?' => 2,
            'Is your character known for award-winning performances?' => 1.5,
            'Is your character linked to Brazil?' => 2,
            'Is your character carioca?' => 2,
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Is your character the villain of City of God?',
            'Seu personagem é o vilão de Cidade de Deus?'
        ));
    }

    private function michaelJordan(): void
    {
        $this->seedCharacter('Michael Jordan', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            'Does your character have dark skin?' => 2,

            'Is your character American?' => 2,
            'Is your character very tall?' => 2,
            'Does your character look muscular?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play basketball professionally?' => 2,
            'Does your character win basketball championships?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 1980s?' => 1.5,
            'Did your character become famous in the 1990s?' => 1.25,
        ], $this->signature(
            'Did your character win six NBA championships?',
            'Seu personagem ganhou seis campeonatos da NBA?'
        ));
    }

    private function albertEinstein(): void
    {
        $this->seedCharacter('Albert Einstein', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,

            'Is your character German?' => 2,
            'Is your character a scientist?' => 2,
            'Is your character known as a professor?' => 1.5,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Has your character won major international awards?' => 2,
            'Did your character have global impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character associated with Europe?' => 2,
            'Is your character linked to United States?' => 1.5,
            'Did your character become famous in the 1920s?' => 2,
        ], $this->signature(
            'Did your character develop the theory of relativity?',
            'Seu personagem desenvolveu a teoria da relatividade?'
        ));
    }

    private function lewisHamilton(): void
    {
        $this->seedCharacter('Lewis Hamilton', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            'Does your character have dark skin?' => 2,

            'Is your character British?' => 2,
            'Is your character described as black?' => 2,
            'Is your character a athlete?' => 2,
            'Is your character associated with motorsports?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Does your character hold multiple records?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character associated with Europe?' => 2,
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Has your character won seven Formula 1 world titles?',
            'Seu personagem ganhou sete títulos mundiais de Fórmula 1?'
        ));
    }

    private function rafaelNadal(): void
    {
        $this->seedCharacter('Rafael Nadal', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character speak Spanish?' => 2,

            'Does your character have fair skin?' => 2,
            'Is your character a athlete?' => 2,
            'Is your character associated with tennis?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Does your character hold multiple records?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character associated with Europe?' => 2,
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Has your character won the most French Open titles in history?',
            'Seu personagem venceu o maior número de Roland Garros na história?'
        ));
    }

    private function stevenSpielberg(): void
    {
        $this->seedCharacter('Steven Spielberg', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,

            'Is your character American?' => 2,
            'Is your character active in cinema?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character known for drama movies?' => 1.5,
            'Is your character known for award-winning performances?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 1970s?' => 1.5,
            'Did your character become famous in the 1980s?' => 1.25,
        ], $this->signature(
            'Did your character direct Jurassic Park?',
            'Seu personagem dirigiu Jurassic Park?'
        ));
    }

    private function elonMusk(): void
    {
        $this->seedCharacter('Elon Musk', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,

            'Is your character American?' => 2,
            'Does your character own a company?' => 2,
            'Does your character manage large teams?' => 1.5,
            'Is your character strategic?' => 2,
            'Is your character analytical?' => 1.5,
            'Does your character live a luxurious lifestyle?' => 2,
            'Is your character associated with controversies?' => 2,
            'Is your character associated with polarizing opinions?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Is your character the CEO of Tesla?',
            'Seu personagem é CEO da Tesla?'
        ));
    }

    private function pabloPicasso(): void
    {
        $this->seedCharacter('Pablo Picasso', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character speak Spanish?' => 2,

            'Does your character have fair skin?' => 2,
            'Is your character linked to France?' => 2,
            'Is your character active in literature?' => 1,
            'Is your character impulsive?' => 1.5,
            'Did your character have cultural impact?' => 2,
            'Did your character have global impact?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character associated with Europe?' => 2,
            'Did your character become famous in the 1910s?' => 2,
        ], $this->signature(
            'Did your character co-found the Cubist movement?',
            'Seu personagem cofundou o movimento cubista?'
        ));
    }

    private function conorMcGregor(): void
    {
        $this->seedCharacter('Conor McGregor', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character speak English?' => 2,

            'Does your character have fair skin?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character compete in mma?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Is your character aggressive?' => 2,
            'Is your character impulsive?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character associated with controversies?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character associated with Europe?' => 2,
            'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Did your character hold UFC titles in two weight classes simultaneously?',
            'Seu personagem foi campeão simultâneo em duas categorias do UFC?'
        ));
    }

    private function rivaldo(): void
    {
        $this->seedCharacter('Rivaldo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            'Does your character have dark skin?' => 2,

            'Is your character described as black?' => 2,
            'Does your character look lean?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 1990s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Did your character win the Ballon d\'Or in 2002?',
            'Seu personagem ganhou a Bola de Ouro em 2002?'
        ));
    }

    private function oscarSchmidt(): void
    {
        $this->seedCharacter('Oscar Schmidt', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,

            'Is your character very tall?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character play basketball professionally?' => 2,
            'Is your character associated with olympic events?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character known by world champion title?' => 1.5,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Did your character score 55 points in a single Olympic game?',
            'Seu personagem marcou 55 pontos em um jogo olímpico?'
        ));
    }

    private function gabrielMedina(): void
    {
        $this->seedCharacter('Gabriel Medina', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character look lean?' => 2,
            'Does your character speak Portuguese?' => 2,

            'Is your character a athlete?' => 2,
            'Is your character associated with surfing?' => 2,
            'Is your character known by world champion title?' => 2,
            'Does your character hold multiple records?' => 1.5,
            'Has your character won major international awards?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Has your character won multiple world surfing titles?',
            'Seu personagem ganhou múltiplos títulos mundiais de surfe?'
        ));
    }

    private function jorgeAmado(): void
    {
        $this->seedCharacter('Jorge Amado', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character speak Portuguese?' => 2,

            'Does your character have fair skin?' => 2,
            'Is your character active in literature?' => 2,
            'Is your character associated with novels?' => 2,
            'Is your character associated with magical realism?' => 2,
            'Is your character associated with writing as profession?' => 2,
            'Did your character have national impact?' => 2,
            'Did your character have cultural impact?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 1.5,
            'Is your character linked to Brazil?' => 2,
            'Is your character baiano?' => 2,
            'Did your character become famous in the 1930s?' => 2,
        ], $this->signature(
            'Did your character write Dona Flor and Her Two Husbands?',
            'Seu personagem escreveu Dona Flor e Seus Dois Maridos?'
        ));
    }

    private function marcosPontes(): void
    {
        $this->seedCharacter('Marcos Pontes', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character speak Portuguese?' => 2,

            'Does your character have fair skin?' => 2,
            'Is your character a scientist?' => 2,
            'Does your character have formal military training?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Did your character have national impact?' => 2,
            'Has your character won national awards?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character paulista?' => 2,
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Was your character the first Brazilian in space?',
            'Seu personagem foi o primeiro brasileiro no espaço?'
        ));
    }

    private function alanTuring(): void
    {
        $this->seedCharacter('Alan Turing', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            'Is your character British?' => 2,
            'Does your character speak English?' => 2,
            'Is your character a scientist?' => 2,
            'Is your character associated with technology?' => 2,
            'Is your character analytical?' => 2,
            'Is your character book-smart?' => 2,
            'Was your character involved in a major war?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Did your character have global impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to United Kingdom?' => 2,
            'Is your character associated with Europe?' => 2,
            'Did your character become famous in the 1940s?' => 2,
        ], $this->signature(
            'Did your character help break the Enigma code?',
            'Seu personagem ajudou a decifrar o código Enigma?'
        ));
    }

    private function bobDylan(): void
    {
        $this->seedCharacter('Bob Dylan', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to folk music?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 1.5],
            'Has your character won major international awards?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known by legend title?' => 2,
            'Did your character become famous in the 1960s?' => 1.5,
            'Did your character become famous in the 1970s?' => 1.25,
        ], $this->signature(
            'Did your character win the Nobel Prize in Literature?',
            'Seu personagem ganhou o Prêmio Nobel de Literatura?'
        ));
    }

    private function pinkPantheress(): void
    {
        $this->seedCharacter('PinkPantheress', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character British?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to electronic music?' => 2,
            'Is your character linked to indie music?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to United Kingdom?' => 2,
            'Did your character become famous in the 2020s?' => 2,
        ], $this->signature(
            'Did your character go viral with the song Illegal?',
            'Seu personagem viralizou com a música Illegal?'
        ));
    }

    private function joanBaez(): void
    {
        $this->seedCharacter('Joan Baez', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to folk music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to songwriting?' => 2,
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 2],
            'Is your character an activist?' => 2,
            'Was your character involved in a social movement?' => 2,
            'Has your character received public recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 1960s?' => 2,
        ], $this->signature(
            'Is your character the biggest female star of folk music?',
            'Seu personagem é a maior estrela feminina de música folk?'
        ));
    }

    private function kateBush(): void
    {
        $this->seedCharacter('Kate Bush', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character British?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to electronic music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to United Kingdom?' => 2,
            'Did your character become famous in the 1970s?' => 1.5,
            'Did your character become famous in the 1980s?' => 1.25,
        ], $this->signature(
            'Did your character release the song Running Up That Hill?',
            'Seu personagem lançou a música Running Up That Hill?'
        ));
    }

    private function frankOcean(): void
    {
        $this->seedCharacter('Frank Ocean', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have dark skin?' => 2,
            'Is your character described as black?' => 2,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to R&B music?' => 2,
            'Is your character linked to hip hop music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to chart-topping songs?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2020s?' => 1.25,
        ], $this->signature(
            'Did your character release the album Channel Orange?',
            'Seu personagem lançou o álbum Channel Orange?'
        ));
    }

    private function robertSmith(): void
    {
        $this->seedCharacter('Robert Smith', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character hair texture straight?' => 2,
            'Is your character British?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to alternative rock?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Has your character received international recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to United Kingdom?' => 2,
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Is your character the lead singer of The Cure?',
            'Seu personagem é o vocalista do The Cure?'
        ));
    }

    private function thomYorke(): void
    {
        $this->seedCharacter('Thom Yorke', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character British?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to alternative rock?' => 2,
            'Is your character linked to electronic music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to United Kingdom?' => 2,
            'Did your character become famous in the 1990s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Is your character the lead singer of Radiohead?',
            'Seu personagem é o vocalista do Radiohead?'
        ));
    }

    private function grimes(): void
    {
        $this->seedCharacter('Grimes', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to electronic music?' => 2,
            'Is your character linked to indie music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Canada?' => 2,
            'Is your character associated with North America?' => 2, // ??
            'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Did your character release the album Visions?',
            'Seu personagem lançou o álbum Visions?'
        ));
    }

    private function bjork(): void
    {
        $this->seedCharacter('Björk', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to electronic music?' => 2,
            'Is your character linked to indie music?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to Iceland?' => 2,
            'Is your character associated with Europe?' => 2,
            'Did your character become famous in the 1990s?' => 1.5,
            'Did your character become famous in the 1980s?' => 1.25,
        ], $this->signature(
            'Did your character release the album Homogenic?',
            'Seu personagem lançou o álbum Homogenic?'
        ));
    }

    private function lanaDelRey(): void
    {
        $this->seedCharacter('Lana Del Rey', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to pop music?' => 2,
            'Is your character linked to indie music?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Is your character linked to live performances?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Did your character release the album Born to Die?',
            'Seu personagem lançou o álbum Born to Die?'
        ));
    }

    private function kurtCobain(): void
    {
        $this->seedCharacter('Kurt Cobain', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            'Is your character hair texture straight?' => 2,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to alternative rock?' => 2,
            'Is your character linked to punk rock?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Did your character die in tragic circumstances?' => 2,
            'Is your character known by legend title?' => 2,
            'Did your character have cultural impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Was your character the frontman of Nirvana?',
            'Seu personagem foi o vocalista do Nirvana?'
        ));
    }

    private function gerardWay(): void
    {
        $this->seedCharacter('Gerard Way', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Is your character American?' => 2,
            'Does your character speak English?' => 2,
            'Is your character active in music?' => 2,
            'Is your character a singer?' => 2,
            'Is your character linked to rock music?' => 2,
            'Is your character linked to punk rock?' => 2,
            'Is your character linked to alternative rock?' => 2,
            'Is your character linked to live performances?' => 2,
            'Is your character linked to songwriting?' => 2,
            'Has your character received public recognition?' => 2,
            'Did your character have cultural impact?' => 1.5,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 2010s?' => 1.25,
        ], $this->signature(
            'Was your character the lead singer of My Chemical Romance?',
            'Seu personagem foi o vocalista do My Chemical Romance?'
        ));
    }

    private function harryPotter(): void
    {
        $this->seedCharacter('Harry Potter', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak English?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            'Is your character primarily a protagonist?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 1.5,
            'Is your character linked to United Kingdom?' => 2,
            'Is your character associated with Europe?' => 2,
            'Is your character book-smart?' => 1.5,
            'Did your character have global impact?' => 2,
            'Did your character have cultural impact?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 1990s?' => 1.25,
            'Is your character idealistic?' => 1.5,
            'Is your character warm and friendly?' => 2,
        ], $this->signature(
            'Does your character have a lightning-shaped scar on his forehead?',
            'Seu personagem tem uma cicatriz em forma de raio na testa?'
        ));
    }

    private function cleopatra(): void
    {
        $this->seedCharacter('Cleópatra', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 1.5,
            'Is your character known as a king or queen?' => 2,
            'Did your character act as a ruler?' => 2,
            'Is your character strategic?' => 2,
            'Is your character associated with ancient history?' => 2,
            'Was your character involved in a major war?' => 1.5,
            'Did your character have global impact?' => 2,
            'Did your character have long-term historical impact?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character known by legend title?' => 2,
            'Is your character linked to Egypt?' => 2,
            'Is your character associated with Africa?' => 2,
        ], $this->signature(
            'Did your character have a relationship with Mark Antony?',
            'Seu personagem teve um relacionamento com Marco Antônio?'
        ));
    }

    private function cheGuevara(): void
    {
        $this->seedCharacter('Che Guevara', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            'Is your character hair texture straight?' => 2,
            'Does your character speak Spanish?' => 2,
            'Is your character a doctor?' => 2,
            'Is your character a revolutionary?' => 2,
            'Is your character an activist?' => 2,
            [SecondaryAttribute::POLITICAL_PROGRESSIVE, 2],
            'Did your character act as a revolutionary?' => 2,
            'Was your character involved in a social movement?' => 2,
            'Was your character involved in a major war?' => 1.5,
            'Did your character have global impact?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character known by a famous nickname?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character linked to Argentina?' => 2,
            'Is your character linked to Cuba?' => 2,
            'Is your character associated with South America?' => 2,
            'Did your character become famous in the 1960s?' => 2,
        ], $this->signature(
            'Is your character\'s face one of the most reproduced images in history?',
            'O rosto do seu personagem é uma das imagens mais reproduzidas da história?'
        ));
    }

    private function narutoUzumaki(): void
    {
        $this->seedCharacter('Naruto Uzumaki', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have blond hair?' => 2,
            'Does your character have fair skin?' => 2,
            'Is your character from an anime?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            'Is your character primarily a protagonist?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character warm and friendly?' => 2,
            'Is your character impulsive?' => 2,
            'Does your character inspire others?' => 2,
            'Does your character lead a team?' => 2,
            'Is your character known by a famous nickname?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Did your character become famous in the 2000s?' => 1.5,
            'Did your character become famous in the 2010s?' => 1.25,
                    'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Does your character dream of becoming Hokage?',
            'Seu personagem sonha em se tornar Hokage?'
        ));
    }

    private function batman(): void
    {
        $this->seedCharacter('Batman', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Does your character have fair skin?' => 2,
            'Does your character speak English?' => 2,
            'Is your character a superhero?' => 2,
            'Is your character associated with mysteries or investigations?' => 2,
            'Is your character primarily a protagonist?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known for action movies?' => 2,
            'Is your character known in tv series?' => 2,
            'Is your character strategic?' => 2,
            'Is your character analytical?' => 2,
            'Does your character live a luxurious lifestyle?' => 2,
            'Is your character morally gray?' => 1.5,
            'Is your character known by a famous nickname?' => 2,
            'Did your character have global impact?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character become famous in the 1960s?' => 1.5,
            'Did your character become famous in the 1940s?' => 1.25,
            'Is your character from the DC universe?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character brooding?' => 2,
            'Is your character known for a secret identity?' => 2,
            'Does your character have a mask?' => 2,
            'Does your character have a cape?' => 2,
                    'Did your character become famous in the 1930s?' => 2,
                    'Is your character human?' => 2,
                    'Does your character investigate crimes?' => 2,
        ], $this->signature(
            'Does your character protect Gotham City?',
            'Seu personagem protege Gotham City?'
        ));
    }

    private function olavoDeCarvalho(): void
    {
        $this->seedCharacter('Olavo de Carvalho', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::AGE_OVER_FORTY, 2],
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_BRAZILIAN, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Does your character have fair skin?' => 2,
            [SecondaryAttribute::RELIGION_CHRISTIAN, 1.5],
            [SecondaryAttribute::POLITICAL_CONSERVATIVE, 2],

            'Does your character speak Portuguese?' => 2,
            'Is your character a teacher?' => 2,
            'Is your character book-smart?' => 2,
            'Is your character analytical?' => 2,
            'Is your character associated with writing as profession?' => 2,
            'Is your character politically active?' => 2,
            'Is your character associated with polarizing opinions?' => 2,
            'Is your character associated with controversies?' => 2,
            'Has your character received public recognition?' => 2,
            'Has your character received media recognition?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Did your character become famous in the 2010s?' => 1.5,
            'Did your character become famous in the 2000s?' => 1.25,
        ], $this->signature(
            'Was your character an advisor to Jair Bolsonaro\'s presidential campaign?',
            'Seu personagem foi conselheiro da campanha presidencial de Jair Bolsonaro?'
        ));
    }

    private function superman(): void
    {
        $this->seedCharacter('Superman', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to advanced technology?' => 1.5,
            'Is your character from the DC universe?' => 2,
            'Is your character idealistic?' => 2,
            'Is your character morally upright?' => 2,
            'Is your character justice-driven?' => 2,
            'Does your character inspire others?' => 2,
            'Is your character known for flying?' => 2,
            'Is your character known for super strength?' => 2,
            'Did your character become famous in the 1930s?' => 2,
            'Is your character an alien or from another planet?' => 2,
            'Does your character have a cape?' => 2,
            'Is your character part of a superhero team?' => 2,
        ], $this->signature(
            'Does your character come from the planet Krypton?',
            'Seu personagem veio do planeta Krypton?'
        ));
    }

    private function homemAranha(): void
    {
        $this->seedCharacter('Homem-Aranha', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character from the Marvel universe?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character impulsive?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character warm and friendly?' => 2,
            'Is your character known for a secret identity?' => 2,
            'Does your character have a mask?' => 2,
            'Does your character inspire others?' => 1.5,
                    'Did your character become famous in the 1960s?' => 2,
                    'Is your character human?' => 2,
                    'Is your character part of a superhero team?' => 2,
        ], $this->signature(
            'Was your character bitten by a radioactive spider?',
            'Seu personagem foi mordido por uma aranha radioativa?'
        ));
    }

    private function mulherMaravilha(): void
    {
        $this->seedCharacter('Mulher-Maravilha', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to magic?' => 1.5,
            'Is your character from the DC universe?' => 2,
            'Is your character idealistic?' => 2,
            'Is your character justice-driven?' => 2,
            'Is your character known for super strength?' => 2,
        ], $this->signature(
            'Is your character an Amazon warrior princess?',
            'Seu personagem é uma princesa guerreira amazona?'
        ));
    }

    private function hulk(): void
    {
        $this->seedCharacter('Hulk', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to advanced technology?' => 1.5,
            'Is your character from the Marvel universe?' => 2,
            'Is your character aggressive?' => 2,
            'Is your character impulsive?' => 2,
            'Is your character known for super strength?' => 2,
        ], $this->signature(
            'Does your character turn green when angry?',
            'Seu personagem fica verde quando fica com raiva?'
        ));
    }

    private function homemDeFerro(): void
    {
        $this->seedCharacter('Homem de Ferro', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to advanced technology?' => 1.5,
            'Is your character from the Marvel universe?' => 2,
            'Does your character make jokes often?' => 1.5,
            'Is your character proud?' => 2,
            'Is your character known for a secret identity?' => 1.5,
        ], $this->signature(
            'Does your character wear a high-tech armored suit?',
            'Seu personagem usa uma armadura high-tech?'
        ));
    }

    private function capitaoAmerica(): void
    {
        $this->seedCharacter('Capitão América', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character primarily a protagonist?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character from the Marvel universe?' => 2,
            'Is your character idealistic?' => 2,
            'Is your character justice-driven?' => 2,
            'Is your character morally upright?' => 2,
        ], $this->signature(
            'Does your character carry a circular vibranium shield?',
            'Seu personagem carrega um escudo circular de vibranium?'
        ));
    }

    private function thor(): void
    {
        $this->seedCharacter('Thor', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to magic?' => 1.5,
            'Is your character from the Marvel universe?' => 2,
            'Is your character proud?' => 2,
            'Is your character known for super strength?' => 2,
                    'Does your character carry a signature weapon?' => 2,
                    'Is your character part of a superhero team?' => 2,
                    'Does your character have a cape?' => 2,
        ], $this->signature(
            'Is your character the god of thunder?',
            'Seu personagem é o deus do trovão?'
        ));
    }

    private function wolverine(): void
    {
        $this->seedCharacter('Wolverine', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character primarily a protagonist?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character from the Marvel universe?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character aggressive?' => 2,
            'Is your character brooding?' => 2,
            'Is your character known for a secret identity?' => 1.5,
                    'Is your character mutant?' => 2,
                    'Does your character carry a signature weapon?' => 2,
                    'Is your character part of a superhero team?' => 2,
        ], $this->signature(
            'Does your character have retractable adamantium claws?',
            'Seu personagem tem garras de adamantium retráteis?'
        ));
    }

    private function deadpool(): void
    {
        $this->seedCharacter('Deadpool', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character morally gray?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Does your character make jokes often?' => 2,
            'Is your character from the Marvel universe?' => 2,
            'Is your character impulsive?' => 2,
        ], $this->signature(
            'Does your character frequently break the fourth wall?',
            'Seu personagem quebra a quarta parede com frequência?'
        ));
    }

    private function coringa(): void
    {
        $this->seedCharacter('Coringa', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Does your character make jokes often?' => 2,
            'Is your character from the DC universe?' => 2,
            'Is your character impulsive?' => 2,
            'Is your character aggressive?' => 2,
        ], $this->signature(
            'Is your character Batman\'s archenemy?',
            'Seu personagem é o arqui-inimigo do Batman?'
        ));
    }

    private function flash(): void
    {
        $this->seedCharacter('Flash', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to advanced technology?' => 1.5,
            'Is your character from the DC universe?' => 2,
            'Is your character impulsive?' => 1.5,
            'Is your character warm and friendly?' => 2,
        ], $this->signature(
            'Is your character the fastest man alive?',
            'Seu personagem é o homem mais rápido vivo?'
        ));
    }

    private function aquaman(): void
    {
        $this->seedCharacter('Aquaman', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to magic?' => 1.5,
            'Is your character from the DC universe?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character proud?' => 1.5,
        ], $this->signature(
            'Is your character the king of Atlantis?',
            'Seu personagem é o rei de Atlântida?'
        ));
    }

    private function thanos(): void
    {
        $this->seedCharacter('Thanos', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to space travel?' => 2,
            'Is your character linked to advanced technology?' => 1.5,
            'Is your character from the Marvel universe?' => 2,
            'Is your character proud?' => 2,
            'Is your character strategic?' => 2,
            'Is your character known for super strength?' => 2,
        ], $this->signature(
            'Did your character snap half the universe away?',
            'Seu personagem estalou os dedos e eliminou metade do universo?'
        ));
    }

    private function venom(): void
    {
        $this->seedCharacter('Venom', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a superhero?' => 2,
            'Is your character morally gray?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character from the Marvel universe?' => 2,
            'Is your character aggressive?' => 2,
        ], $this->signature(
            'Is your character bonded with a symbiotic alien?',
            'Seu personagem está ligado a um simbionte alienígena?'
        ));
    }

    private function darthVader(): void
    {
        $this->seedCharacter('Darth Vader', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_DECEASED, 2],
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to space travel?' => 2,
            'Is your character linked to advanced technology?' => 1.5,
            'Is your character from the Star Wars saga?' => 2,
            'Does your character carry a signature weapon?' => 2,
            'Does your character wear armor?' => 2,
            'Does your character have a mask?' => 2,
        ], $this->signature(
            'Is your character Luke Skywalker\'s father?',
            'Seu personagem é o pai de Luke Skywalker?'
        ));
    }

    private function yoda(): void
    {
        $this->seedCharacter('Yoda', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character primarily a mentor?' => 2,
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to space travel?' => 2,
            'Is your character linked to advanced technology?' => 1.5,
            'Is your character from the Star Wars saga?' => 2,
            'Is your character an alien or from another planet?' => 2,
        ], $this->signature(
            'Does your character speak in inverted sentence order?',
            'Seu personagem fala com a ordem das frases invertida?'
        ));
    }

    private function lukeSkywalker(): void
    {
        $this->seedCharacter('Luke Skywalker', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to space travel?' => 2,
            'Is your character linked to advanced technology?' => 1.5,
            'Is your character from the Star Wars saga?' => 2,
            'Is your character human?' => 2,
            'Does your character carry a signature weapon?' => 2,
        ], $this->signature(
            'Did your character destroy the Death Star?',
            'Seu personagem destruiu a Estrela da Morte?'
        ));
    }

    private function patoDonald(): void
    {
        $this->seedCharacter('Pato Donald', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
                    'Did your character become famous in the 1930s?' => 2,
        ], $this->signature(
            'Does your character have a famously bad temper?',
            'Seu personagem tem um temperamento infame?'
        ));
    }

    private function pernaLonga(): void
    {
        $this->seedCharacter('Perna Longa', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character anthropomorphic?' => 2,
            'Is your character associated with an animal?' => 2,
        ], $this->signature(
            'Is your character a tall anthropomorphic dog?',
            'Seu personagem é um cachorro antropomórfico alto?'
        ));
    }

    private function bugsBunny(): void
    {
        $this->seedCharacter('Pernalonga', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Does your character say "What\'s up, Doc?"',
            'Seu personagem fala "E aí, Doc?"?'
        ));
    }

    private function patolino(): void
    {
        $this->seedCharacter('Patolino', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Is your character famously unlucky and jealous?',
            'Seu personagem é famoso por azar e ciúmes?'
        ));
    }

    private function scoobyDoo(): void
    {
        $this->seedCharacter('Scooby-Doo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character associated with mysteries or investigations?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Does your character solve mysteries with friends in a van?',
            'Seu personagem resolve mistérios com amigos em uma van?'
        ));
    }

    private function patrickEstrela(): void
    {
        $this->seedCharacter('Patrick Estrela', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Does your character live under a rock in Bikini Bottom?',
            'Seu personagem mora debaixo de uma pedra na Fenda do Bikini?'
        ));
    }

    private function picaPau(): void
    {
        $this->seedCharacter('Pica-Pau', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Does your character have a distinctive laugh?',
            'Seu personagem tem uma risada característica?'
        ));
    }

    private function popeye(): void
    {
        $this->seedCharacter('Popeye', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character anthropomorphic?' => 2,
                    'Did your character become famous in the 1920s?' => 2,
        ], $this->signature(
            'Does your character gain strength from eating spinach?',
            'Seu personagem fica forte ao comer espinafre?'
        ));
    }

    private function shrek(): void
    {
        $this->seedCharacter('Shrek', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Is your character a green ogre from a swamp?',
            'Seu personagem é um ogro verde de um pântano?'
        ));
    }

    private function burro(): void
    {
        $this->seedCharacter('Burro', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character linked to magic?' => 1.5,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Is your character a talking donkey sidekick?',
            'Seu personagem é um burro falante parceiro de aventuras?'
        ));
    }

    private function simba(): void
    {
        $this->seedCharacter('Simba', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to magic?' => 1.5,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Did your character become king of the Pride Lands?',
            'Seu personagem se tornou rei das Terras do Orgulho?'
        ));
    }

    private function elsa(): void
    {
        $this->seedCharacter('Elsa', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to magic?' => 1.5,
                    'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Does your character have ice powers?',
            'Seu personagem tem poderes de gelo?'
        ));
    }

    private function moana(): void
    {
        $this->seedCharacter('Moana', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Did your character sail across the ocean to restore the heart of Te Fiti?',
            'Seu personagem navegou pelo oceano para restaurar o coração de Te Fiti?'
        ));
    }

    private function mulan(): void
    {
        $this->seedCharacter('Mulan', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Did your character disguise herself as a soldier?',
            'Seu personagem se disfarçou de soldado?'
        ));
    }

    private function cinderela(): void
    {
        $this->seedCharacter('Cinderela', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Did your character lose a glass slipper at midnight?',
            'Seu personagem perdeu um sapatinho de cristal à meia-noite?'
        ));
    }

    private function brancaDeNeve(): void
    {
        $this->seedCharacter('Branca de Neve', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Did seven dwarfs shelter your character?',
            'Sete anões abrigaram seu personagem?'
        ));
    }

    private function aladdin(): void
    {
        $this->seedCharacter('Aladdin', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Did your character find a magic lamp?',
            'Seu personagem encontrou uma lâmpada mágica?'
        ));
    }

    private function genio(): void
    {
        $this->seedCharacter('Gênio', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to magic?' => 1.5,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Can your character grant three wishes?',
            'Seu personagem pode conceder três desejos?'
        ));
    }

    private function buzzLightyear(): void
    {
        $this->seedCharacter('Buzz Lightyear', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character linked to space travel?' => 2,
            'Is your character linked to advanced technology?' => 1.5,
        ], $this->signature(
            'Does your character believe he is a real space ranger?',
            'Seu personagem acredita que é um ranger espacial de verdade?'
        ));
    }

    private function woody(): void
    {
        $this->seedCharacter('Woody', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Is your character a cowboy doll leader of toys?',
            'Seu personagem é um caubói de brinquedo líder dos brinquedos?'
        ));
    }

    private function nemo(): void
    {
        $this->seedCharacter('Nemo', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Did your character get lost in the ocean as a clownfish?',
            'Seu personagem se perdeu no oceano sendo um peixe-palhaço?'
        ));
    }

    private function stitch(): void
    {
        $this->seedCharacter('Stitch', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character linked to United States?' => 2,
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character linked to space travel?' => 2,
            'Is your character linked to advanced technology?' => 1.5,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Is your character Experiment 626?',
            'Seu personagem é o Experimento 626?'
        ));
    }

    private function sasukeUchiha(): void
    {
        $this->seedCharacter('Sasuke Uchiha', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            'Is your character morally gray?' => 2,
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Is your character brooding?' => 2,
            'Is your character proud?' => 2,
        ], $this->signature(
            'Is your character obsessed with revenge against his brother?',
            'Seu personagem é obcecado por vingança contra o irmão?'
        ));
    }

    private function goku(): void
    {
        $this->seedCharacter('Goku', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Is your character linked to magic?' => 1.5,
            'Is your character warm and friendly?' => 2,
            'Is your character impulsive?' => 1.5,
            'Does your character inspire others?' => 2,
        ], $this->signature(
            'Does your character transform into a Super Saiyan?',
            'Seu personagem se transforma em Super Saiyajin?'
        ));
    }

    private function vegeta(): void
    {
        $this->seedCharacter('Vegeta', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character morally gray?' => 2,
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Is your character linked to magic?' => 1.5,
            'Is your character aggressive?' => 2,
            'Is your character proud?' => 2,
        ], $this->signature(
            'Is your character a proud Saiyan prince?',
            'Seu personagem é um orgulhoso príncipe Saiyajin?'
        ));
    }

    private function luffy(): void
    {
        $this->seedCharacter('Luffy', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Is your character linked to magic?' => 1.5,
            'Is your character impulsive?' => 2,
            'Is your character warm and friendly?' => 2,
        ], $this->signature(
            'Does your character want to become the Pirate King?',
            'Seu personagem quer se tornar o Rei dos Piratas?'
        ));
    }

    private function pikachu(): void
    {
        $this->seedCharacter('Pikachu', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Is your character the mascot of Pokémon?',
            'Seu personagem é o mascote de Pokémon?'
        ));
    }

    private function ashKetchum(): void
    {
        $this->seedCharacter('Ash Ketchum', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
        ], $this->signature(
            'Does your character want to be a Pokémon Master?',
            'Seu personagem quer ser um Mestre Pokémon?'
        ));
    }

    private function sailorMoon(): void
    {
        $this->seedCharacter('Sailor Moon', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Does your character fight evil as a magical girl?',
            'Seu personagem combate o mal como uma garota mágica?'
        ));
    }

    private function totoro(): void
    {
        $this->seedCharacter('Totoro', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Is your character a giant forest spirit?',
            'Seu personagem é um espírito gigante da floresta?'
        ));
    }

    private function leviAckerman(): void
    {
        $this->seedCharacter('Levi Ackerman', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
        ], $this->signature(
            'Is your character humanity\'s last hope against monsters?',
            'Seu personagem é a última esperança da humanidade contra monstros?'
        ));
    }

    private function lightYagami(): void
    {
        $this->seedCharacter('Light Yagami', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character associated with mysteries or investigations?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Is your character analytical?' => 2,
            'Is your character strategic?' => 2,
            'Is your character proud?' => 1.5,
        ], $this->signature(
            'Does your character use a Death Note?',
            'Seu personagem usa um Death Note?'
        ));
    }

    private function edwardElric(): void
    {
        $this->seedCharacter('Edward Elric', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Did your character lose limbs in an alchemical accident?',
            'Seu personagem perdeu membros em um acidente alquímico?'
        ));
    }

    private function kirito(): void
    {
        $this->seedCharacter('Kirito', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character from a science fiction setting?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Is your character linked to magic?' => 1.5,
            'Is your character linked to advanced technology?' => 1.5,
        ], $this->signature(
            'Is your character known as the Black Swordsman in virtual worlds?',
            'Seu personagem é conhecido como o Espadachim Negro em mundos virtuais?'
        ));
    }

    private function saitama(): void
    {
        $this->seedCharacter('Saitama', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character calm?' => 2,
            'Is your character known for super strength?' => 2,
        ], $this->signature(
            'Can your character defeat enemies with a single punch?',
            'Seu personagem consegue derrotar inimigos com um soco?'
        ));
    }

    private function deku(): void
    {
        $this->seedCharacter('Deku', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an anime?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known in tv series?' => 2,
            'Is your character linked to Japan?' => 2,
            'Is your character associated with Asia?' => 2,
            'Is your character idealistic?' => 2,
            'Is your character warm and friendly?' => 2,
            'Does your character inspire others?' => 2,
                    'Is your character part of a superhero team?' => 2,
                    'Does your character have special powers?' => 2,
        ], $this->signature(
            'Did your character inherit One For All?',
            'Seu personagem herdou o One For All?'
        ));
    }

    private function cebolinha(): void
    {
        $this->seedCharacter('Cebolinha', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak Portuguese?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character known in tv series?' => 1.5,
            'Does your character make jokes often?' => 1.5,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Does your character speak with reversed R sounds?',
            'Seu personagem fala invertendo os Rs?'
        ));
    }

    private function cascao(): void
    {
        $this->seedCharacter('Cascão', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak Portuguese?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character known in tv series?' => 1.5,
            'Does your character make jokes often?' => 1.5,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Is your character afraid of taking baths?',
            'Seu personagem tem medo de tomar banho?'
        ));
    }

    private function magali(): void
    {
        $this->seedCharacter('Magali', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak Portuguese?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character known in tv series?' => 1.5,
            'Does your character make jokes often?' => 1.5,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Is your character obsessed with food and boys?',
            'Seu personagem é obcecada por comida e garotos?'
        ));
    }

    private function chicoBento(): void
    {
        $this->seedCharacter('Chico Bento', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak Portuguese?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character known in tv series?' => 1.5,
            'Does your character make jokes often?' => 1.5,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Does your character live on a farm and hate school?',
            'Seu personagem mora na roça e odeia escola?'
        ));
    }

    private function benji(): void
    {
        $this->seedCharacter('Benji', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak Portuguese?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character known in tv series?' => 1.5,
            'Does your character make jokes often?' => 1.5,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Is your character a ghost boy from Brazilian comics?',
            'Seu personagem é um menino fantasma dos quadrinhos brasileiros?'
        ));
    }

    private function seuMadruga(): void
    {
        $this->seedCharacter('Seu Madruga', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character morally gray?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character known in tv series?' => 1.5,
            'Does your character make jokes often?' => 1.5,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Does your character owe rent to Señor Barriga?',
            'Seu personagem deve aluguel ao Seu Barriga?'
        ));
    }

    private function chapolinColorado(): void
    {
        $this->seedCharacter('Chapolin Colorado', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak Portuguese?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character known in tv series?' => 1.5,
            'Does your character make jokes often?' => 1.5,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Does your character fight injustice with a red hammer?',
            'Seu personagem combate injustiças com um martelo vermelho?'
        ));
    }

    private function tioBarnabe(): void
    {
        $this->seedCharacter('Tio Barnabé', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character morally gray?' => 2,
            'Does your character speak Portuguese?' => 2,
            'Is your character linked to Brazil?' => 2,
            'Is your character known in tv series?' => 1.5,
            'Does your character make jokes often?' => 1.5,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Is your character a classic Brazilian TV comedy character?',
            'Seu personagem é um clássico da comédia brasileira na TV?'
        ));
    }

    private function mario(): void
    {
        $this->seedCharacter('Mario', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Did your character become famous in the 1980s?' => 2,
            'Is your character from Nintendo?' => 2,
            'Does your character collect coins or items?' => 2,
            'Does your character jump on platforms?' => 2,
        ], $this->signature(
            'Does your character jump on Goombas in the Mushroom Kingdom?',
            'Seu personagem pula em Goombas no Reino Cogumelo?'
        ));
    }

    private function luigi(): void
    {
        $this->seedCharacter('Luigi', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Is your character Mario\'s taller brother?',
            'Seu personagem é o irmão mais alto do Mario?'
        ));
    }

    private function sonic(): void
    {
        $this->seedCharacter('Sonic', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Can your character run faster than the speed of sound?',
            'Seu personagem corre mais rápido que a velocidade do som?'
        ));
    }

    private function kirby(): void
    {
        $this->seedCharacter('Kirby', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Can your character inhale enemies to copy their powers?',
            'Seu personagem pode inalar inimigos para copiar poderes?'
        ));
    }

    private function link(): void
    {
        $this->seedCharacter('Link', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character have cultural impact?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Does your character wield the Master Sword?',
            'Seu personagem empunha a Master Sword?'
        ));
    }

    private function crashBandicoot(): void
    {
        $this->seedCharacter('Crash Bandicoot', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Does your character spin to defeat enemies on Wumpa Island?',
            'Seu personagem gira para derrotar inimigos na Ilha Wumpa?'
        ));
    }

    private function laraCroft(): void
    {
        $this->seedCharacter('Lara Croft', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            'Is your character associated with mysteries or investigations?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character have cultural impact?' => 2,
        ], $this->signature(
            'Is your character a tomb-raiding archaeologist?',
            'Seu personagem é uma arqueóloga caçadora de tumbas?'
        ));
    }

    private function masterChief(): void
    {
        $this->seedCharacter('Master Chief', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character have cultural impact?' => 2,
            'Is your character linked to space travel?' => 2,
            'Is your character linked to advanced technology?' => 1.5,
        ], $this->signature(
            'Does your character wear green Spartan armor numbered 117?',
            'Seu personagem usa armadura Spartan verde número 117?'
        ));
    }

    private function kratos(): void
    {
        $this->seedCharacter('Kratos', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character morally gray?' => 2,
            'Did your character have cultural impact?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Did your character seek revenge against the gods of Olympus?',
            'Seu personagem buscou vingança contra os deuses do Olimpo?'
        ));
    }

    private function pacMan(): void
    {
        $this->seedCharacter('Pac-Man', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Does your character eat dots while fleeing ghosts in a maze?',
            'Seu personagem come bolinhas fugindo de fantasmas em um labirinto?'
        ));
    }

    private function donkeyKong(): void
    {
        $this->seedCharacter('Donkey Kong', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character have cultural impact?' => 2,
            'Does your character make jokes often?' => 2,
            'Is your character associated with an animal?' => 2,
            'Is your character anthropomorphic?' => 2,
        ], $this->signature(
            'Does your character throw barrels on a construction site?',
            'Seu personagem joga barris em um canteiro de obras?'
        ));
    }

    private function steve(): void
    {
        $this->seedCharacter('Steve', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a video game?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character aimed at a children\'s audience?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character have cultural impact?' => 2,
        ], $this->signature(
            'Can your character mine blocks and craft tools in a cubic world?',
            'Seu personagem minera blocos e cria ferramentas em um mundo cúbico?'
        ));
    }

    private function hermioneGranger(): void
    {
        $this->seedCharacter('Hermione Granger', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Is your character the brightest witch of her age at Hogwarts?',
            'Seu personagem é a bruxa mais inteligente da idade em Hogwarts?'
        ));
    }

    private function voldemort(): void
    {
        $this->seedCharacter('Voldemort', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Is your character known as the Dark Lord?',
            'Seu personagem é conhecido como o Lorde das Trevas?'
        ));
    }

    private function jamesBond(): void
    {
        $this->seedCharacter('James Bond', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character associated with mysteries or investigations?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
        ], $this->signature(
            'Does your character prefer his martinis shaken, not stirred?',
            'Seu personagem prefere martini shaken, not stirred?'
        ));
    }

    private function indianaJones(): void
    {
        $this->seedCharacter('Indiana Jones', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character associated with mysteries or investigations?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
        ], $this->signature(
            'Does your character wear a fedora and carry a whip?',
            'Seu personagem usa chapéu fedora e carrega um chicote?'
        ));
    }

    private function forrestGump(): void
    {
        $this->seedCharacter('Forrest Gump', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Does your character make jokes often?' => 2,
        ], $this->signature(
            'Did your character say life is like a box of chocolates?',
            'Seu personagem disse que a vida é como uma caixa de bombons?'
        ));
    }

    private function jackSparrow(): void
    {
        $this->seedCharacter('Jack Sparrow', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character morally gray?' => 2,
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Does your character make jokes often?' => 2,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Is your character a quirky pirate captain of the Black Pearl?',
            'Seu personagem é um capitão pirata excêntrico do Pérola Negra?'
        ));
    }

    private function rockyBalboa(): void
    {
        $this->seedCharacter('Rocky Balboa', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character primarily a protagonist?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
        ], $this->signature(
            'Did your character fight Apollo Creed in Philadelphia?',
            'Seu personagem lutou contra Apollo Creed na Filadélfia?'
        ));
    }

    private function terminator(): void
    {
        $this->seedCharacter('Terminator', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to advanced technology?' => 1.5,
                    'Is your character android?' => 2,
        ], $this->signature(
            'Does your character say that he will be back?',
            'Seu personagem diz que voltará?'
        ));
    }

    private function neo(): void
    {
        $this->seedCharacter('Neo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to advanced technology?' => 1.5,
        ], $this->signature(
            'Did your character choose the red pill?',
            'Seu personagem escolheu a pílula vermelha?'
        ));
    }

    private function gandalf(): void
    {
        $this->seedCharacter('Gandalf', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character primarily a mentor?' => 2,
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to magic?' => 1.5,
                    'Is your character a magic user?' => 2,
                    'Does your character carry a signature weapon?' => 2,
        ], $this->signature(
            'Is your character a wizard who says you shall not pass?',
            'Seu personagem é um mago que diz you shall not pass?'
        ));
    }

    private function frodo(): void
    {
        $this->seedCharacter('Frodo', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character popular with teenagers or young adults?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to magic?' => 1.5,
        ], $this->signature(
            'Was your character tasked with destroying the One Ring?',
            'Seu personagem foi encarregado de destruir o Um Anel?'
        ));
    }

    private function jonSnow(): void
    {
        $this->seedCharacter('Jon Snow', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character speak English?' => 2,
            'Is your character known for action movies?' => 1.5,
            'Is your character linked to magic?' => 1.5,
            'Is your character known for drama movies?' => 1.5,
        ], $this->signature(
            'Does your character know nothing?',
            'Seu personagem não sabe de nada?'
        ));
    }

    private function walterWhite(): void
    {
        $this->seedCharacter('Walter White', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character from a live-action film or series?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character morally gray?' => 2,
            'Does your character speak English?' => 2,
            'Is your character known for drama movies?' => 2,
        ], $this->signature(
            'Did your character cook blue meth as Heisenberg?',
            'Seu personagem cozinhou metanfetamina azul como Heisenberg?'
        ));
    }

    private function quico(): void
    {
        $this->seedCharacter('Quico', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character from a comedy?' => 2,
            'Does your character appear in slapstick humor?' => 2,
            'Did your character become famous in the 1970s?' => 2,
        ], $this->signature(
            'Is your character spoiled and cries often on a Mexican sitcom?',
            'Seu personagem é mimado e chora muito em uma sitcom mexicana?'
        ));
    }


    private function donaFlorinda(): void
    {
        $this->seedCharacter('Dona Florinda', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character from a comedy?' => 2,
            'Did your character become famous in the 1970s?' => 2,
        ], $this->signature(
            'Is your character a widow who runs a boarding house?',
            'Seu personagem é viúva e administra uma pensão?'
        ));
    }


    private function professorGirafales(): void
    {
        $this->seedCharacter('Professor Girafales', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character primarily a mentor?' => 2,
            'Did your character become famous in the 1970s?' => 2,
        ], $this->signature(
            'Is your character a teacher in love with Dona Florinda?',
            'Seu personagem é professor apaixonado pela Dona Florinda?'
        ));
    }


    private function chiquinha(): void
    {
        $this->seedCharacter('Chiquinha', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character from a comedy?' => 2,
            'Did your character become famous in the 1970s?' => 2,
        ], $this->signature(
            'Is your character the daughter of Dona Florinda?',
            'Seu personagem é filha da Dona Florinda?'
        ));
    }


    private function seuBarriga(): void
    {
        $this->seedCharacter('Seu Barriga', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character from a comedy?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Did your character become famous in the 1970s?' => 2,
        ], $this->signature(
            'Is your character the landlord who collects rent?',
            'Seu personagem é o senhorio que cobra aluguel?'
        ));
    }


    private function dumbledore(): void
    {
        $this->seedCharacter('Dumbledore', [
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character primarily a mentor?' => 2,
            'Is your character a magic user?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Is your character the headmaster of Hogwarts?',
            'Seu personagem é o diretor de Hogwarts?'
        ));
    }


    private function snape(): void
    {
        $this->seedCharacter('Snape', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character a magic user?' => 2,
            'Is your character morally gray?' => 2,
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Is your character the potions master at Hogwarts?',
            'Seu personagem é o mestre de poções em Hogwarts?'
        ));
    }


    private function ronyWeasley(): void
    {
        $this->seedCharacter('Rony Weasley', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character a magic user?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Is your character Harry Potter\'s best friend?',
            'Seu personagem é o melhor amigo de Harry Potter?'
        ));
    }


    private function hagrid(): void
    {
        $this->seedCharacter('Hagrid', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character primarily a mentor?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Is your character the half-giant groundskeeper of Hogwarts?',
            'Seu personagem é o guarda-caça meio-gigante de Hogwarts?'
        ));
    }


    private function dracoMalfoy(): void
    {
        $this->seedCharacter('Draco Malfoy', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character a magic user?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Is your character from Slytherin house?',
            'Seu personagem é da casa Sonserina?'
        ));
    }


    private function dobby(): void
    {
        $this->seedCharacter('Dobby', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character a magic user?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Is your character a house-elf?',
            'Seu personagem é um elfo doméstico?'
        ));
    }


    private function siriusBlack(): void
    {
        $this->seedCharacter('Sirius Black', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            'Is your character a magic user?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Is your character Harry Potter\'s godfather?',
            'Seu personagem é o padrinho de Harry Potter?'
        ));
    }


    private function aragorn(): void
    {
        $this->seedCharacter('Aragorn', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character carry a signature weapon?' => 2,
            'Is your character known as a king or queen?' => 2,
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Is your character the rightful king of Gondor?',
            'Seu personagem é o legítimo rei de Gondor?'
        ));
    }


    private function legolas(): void
    {
        $this->seedCharacter('Legolas', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character carry a signature weapon?' => 2,
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Is your character an elven archer from Mirkwood?',
            'Seu personagem é um arqueiro elfo de Mirkwood?'
        ));
    }


    private function gimli(): void
    {
        $this->seedCharacter('Gimli', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character carry a signature weapon?' => 2,
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Is your character a dwarf warrior?',
            'Seu personagem é um guerreiro anão?'
        ));
    }


    private function gollum(): void
    {
        $this->seedCharacter('Gollum', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Does your character obsess over a precious ring?',
            'Seu personagem é obcecado por um anel precioso?'
        ));
    }


    private function sauron(): void
    {
        $this->seedCharacter('Sauron', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Is your character a magic user?' => 2,
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Is your character the Dark Lord of Middle-earth?',
            'Seu personagem é o Senhor das Trevas da Terra-média?'
        ));
    }


    private function bilbo(): void
    {
        $this->seedCharacter('Bilbo', [
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Did your character find the One Ring in a cave?',
            'Seu personagem encontrou o Um Anel em uma caverna?'
        ));
    }


    private function sam(): void
    {
        $this->seedCharacter('Sam', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character become famous in the 2000s?' => 2,
        ], $this->signature(
            'Is your character Frodo\'s loyal gardener?',
            'Seu personagem é o fiel jardineiro de Frodo?'
        ));
    }


    private function hanSolo(): void
    {
        $this->seedCharacter('Han Solo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            'Is your character from the Star Wars saga?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character carry a signature weapon?' => 2,
            'Is your character human?' => 2,
            'Did your character become famous in the 1970s?' => 2,
        ], $this->signature(
            'Does your character pilot the Millennium Falcon?',
            'Seu personagem pilota a Millennium Falcon?'
        ));
    }


    private function princesaLeia(): void
    {
        $this->seedCharacter('Princesa Leia', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            'Is your character from the Star Wars saga?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character human?' => 2,
            'Is your character known as a king or queen?' => 2,
            'Did your character become famous in the 1970s?' => 2,
        ], $this->signature(
            'Is your character a princess of Alderaan?',
            'Seu personagem é princesa de Alderaan?'
        ));
    }


    private function chewbacca(): void
    {
        $this->seedCharacter('Chewbacca', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            'Is your character from the Star Wars saga?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character an alien or from another planet?' => 2,
            'Did your character become famous in the 1970s?' => 2,
        ], $this->signature(
            'Is your character a Wookiee co-pilot?',
            'Seu personagem é um Wookiee copiloto?'
        ));
    }


    private function obiWanKenobi(): void
    {
        $this->seedCharacter('Obi-Wan Kenobi', [
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            'Is your character from the Star Wars saga?' => 2,
            'Is your character primarily a mentor?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character carry a signature weapon?' => 2,
            'Is your character human?' => 2,
            'Did your character become famous in the 1970s?' => 2,
        ], $this->signature(
            'Is your character a Jedi master who trained Luke Skywalker?',
            'Seu personagem é um mestre Jedi que treinou Luke Skywalker?'
        ));
    }


    private function grogu(): void
    {
        $this->seedCharacter('Grogu', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a science fiction setting?' => 2,
            'Is your character from the Star Wars saga?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character an alien or from another planet?' => 2,
            'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Is your character a small green Force-sensitive child?',
            'Seu personagem é uma criança verde sensível à Força?'
        ));
    }


    private function frajola(): void
    {
        $this->seedCharacter('Frajola', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from an animated show or movie?' => 2,
            'Is your character from a comedy?' => 2,
            'Does your character appear in slapstick humor?' => 2,
            'Is your character anthropomorphic?' => 2,
            'Did your character become famous in the 1940s?' => 2,
        ], $this->signature(
            'Is your character a cat always chasing a canary?',
            'Seu personagem é um gato que persegue um canário?'
        ));
    }


    private function piuPiu(): void
    {
        $this->seedCharacter('Piu-Piu', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from an animated show or movie?' => 2,
            'Is your character from a comedy?' => 2,
            'Does your character appear in slapstick humor?' => 2,
            'Is your character anthropomorphic?' => 2,
            'Did your character become famous in the 1940s?' => 2,
        ], $this->signature(
            'Is your character a yellow canary?',
            'Seu personagem é um passarinho amarelo?'
        ));
    }


    private function taz(): void
    {
        $this->seedCharacter('Taz', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from an animated show or movie?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character anthropomorphic?' => 2,
            'Did your character become famous in the 1950s?' => 2,
        ], $this->signature(
            'Is your character a spinning Tasmanian devil?',
            'Seu personagem é um diabo da Tasmânia que gira?'
        ));
    }


    private function bartSimpson(): void
    {
        $this->seedCharacter('Bart Simpson', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from an animated show or movie?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character known in tv series?' => 2,
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Does your character say "Eat my shorts"?',
            'Seu personagem diz "Coma minhas cuecas"?'
        ));
    }


    private function lisaSimpson(): void
    {
        $this->seedCharacter('Lisa Simpson', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from an animated show or movie?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character known in tv series?' => 2,
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Does your character play the saxophone?',
            'Seu personagem toca saxofone?'
        ));
    }


    private function margeSimpson(): void
    {
        $this->seedCharacter('Marge Simpson', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from an animated show or movie?' => 2,
            'Is your character from a comedy?' => 2,
            'Is your character known in tv series?' => 2,
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Does your character have a tall blue beehive hairdo?',
            'Seu personagem tem um penteado azul alto?'
        ));
    }


    private function dracula(): void
    {
        $this->seedCharacter('Drácula', [
            [InitialAttribute::AGE_ELDERLY, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a horror story?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Is your character vampire?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Did your character become famous in the 1920s?' => 2,
        ], $this->signature(
            'Is your character a count from Transylvania?',
            'Seu personagem é um conde da Transilvânia?'
        ));
    }


    private function pennywise(): void
    {
        $this->seedCharacter('Pennywise', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from a horror story?' => 2,
            'Is your character from a live-action film or series?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Is your character a shapeshifting clown from Derry?',
            'Seu personagem é um palhaço metamorfo de Derry?'
        ));
    }


    private function sherlockHolmes(): void
    {
        $this->seedCharacter('Sherlock Holmes', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character associated with mysteries or investigations?' => 2,
            'Is your character from a live-action film or series?' => 2,
            'Does your character investigate crimes?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character analytical?' => 2,
            'Did your character become famous in the 1900s?' => 2,
        ], $this->signature(
            'Does your character live at 221B Baker Street?',
            'Seu personagem mora na Baker Street 221B?'
        ));
    }


    private function loki(): void
    {
        $this->seedCharacter('Loki', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character a superhero?' => 2,
            'Is your character from the Marvel universe?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character morally gray?' => 2,
            'Is your character a magic user?' => 2,
            'Is your character an alien or from another planet?' => 2,
            'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Is your character the god of mischief?',
            'Seu personagem é o deus da travessura?'
        ));
    }


    private function doutorEstranho(): void
    {
        $this->seedCharacter('Doutor Estranho', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character a superhero?' => 2,
            'Is your character from the Marvel universe?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character a magic user?' => 2,
            'Is your character part of a superhero team?' => 2,
            'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Is your character the Sorcerer Supreme?',
            'Seu personagem é o Mago Supremo?'
        ));
    }


    private function arlequina(): void
    {
        $this->seedCharacter('Arlequina', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from the DC universe?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Is your character morally gray?' => 2,
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Is your character the Joker\'s girlfriend?',
            'Seu personagem é namorada do Coringa?'
        ));
    }


    private function lexLuthor(): void
    {
        $this->seedCharacter('Lex Luthor', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from the DC universe?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Is your character a superhero?' => 2,
            'Did your character become famous in the 1940s?' => 2,
        ], $this->signature(
            'Is your character Superman\'s greatest enemy?',
            'Seu personagem é o maior inimigo do Superman?'
        ));
    }


    private function scar(): void
    {
        $this->seedCharacter('Scar', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from Disney?' => 2,
            'Is your character from an animated show or movie?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Is your character anthropomorphic?' => 2,
            'Is your character associated with an animal?' => 2,
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Did your character cause Mufasa\'s death?',
            'Seu personagem causou a morte de Mufasa?'
        ));
    }


    private function maleficent(): void
    {
        $this->seedCharacter('Maleficent', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from Disney?' => 2,
            'Is your character from an animated show or movie?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Is your character a magic user?' => 2,
            'Did your character become famous in the 1950s?' => 2,
        ], $this->signature(
            'Did your character curse a princess to sleep?',
            'Seu personagem amaldiçoou uma princesa a dormir?'
        ));
    }


    private function seiya(): void
    {
        $this->seedCharacter('Seiya', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from an anime?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character wear armor?' => 2,
            'Does your character carry a signature weapon?' => 2,
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Is your character a Bronze Saint of Pegasus?',
            'Seu personagem é o Cavaleiro de Pégaso?'
        ));
    }


    private function piccolo(): void
    {
        $this->seedCharacter('Piccolo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from an anime?' => 2,
            'Is your character primarily a mentor?' => 2,
            'Is your character an alien or from another planet?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Is your character a Namekian who trained Gohan?',
            'Seu personagem é um Namekuseijin que treinou Gohan?'
        ));
    }


    private function kakashi(): void
    {
        $this->seedCharacter('Kakashi', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from an anime?' => 2,
            'Is your character primarily a mentor?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character have a mask?' => 2,
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Does your character wear a mask and have a Sharingan?',
            'Seu personagem usa máscara e tem Sharingan?'
        ));
    }


    private function zoro(): void
    {
        $this->seedCharacter('Zoro', [
            [InitialAttribute::AGE_TEENAGER, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from an anime?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Does your character carry a signature weapon?' => 2,
            'Did your character become famous in the 1990s?' => 2,
        ], $this->signature(
            'Does your character fight with three swords?',
            'Seu personagem luta com três espadas?'
        ));
    }


    private function princesaPeach(): void
    {
        $this->seedCharacter('Princesa Peach', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from Nintendo?' => 2,
            'Is your character from a video game?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character known as a king or queen?' => 2,
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Is your character the ruler of the Mushroom Kingdom?',
            'Seu personagem é a governante do Reino Cogumelo?'
        ));
    }


    private function bowser(): void
    {
        $this->seedCharacter('Bowser', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from Nintendo?' => 2,
            'Is your character from a video game?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Is your character anthropomorphic?' => 2,
            'Did your character become famous in the 1980s?' => 2,
        ], $this->signature(
            'Is your character a turtle king who kidnaps princesses?',
            'Seu personagem é um rei tartaruga que sequestra princesas?'
        ));
    }


    private function emilia(): void
    {
        $this->seedCharacter('Emília', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_FEMALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character anthropomorphic?' => 2,
            'Did your character become famous in the 1950s?' => 2,
        ], $this->signature(
            'Is your character a talking doll with a nutmeg head?',
            'Seu personagem é uma boneca de pano com cabeça de noz-moscada?'
        ));
    }


    private function saciPerere(): void
    {
        $this->seedCharacter('Saci-Pererê', [
            [InitialAttribute::AGE_CHILD, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character primarily a protagonist?' => 2,
            'Is your character from Brazilian comics or TV comedy?' => 2,
            'Is your character from a fantasy setting?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Did your character become famous in the 1950s?' => 2,
        ], $this->signature(
            'Does your character have only one leg and smokes a pipe?',
            'Seu personagem tem uma perna só e fuma cachimbo?'
        ));
    }


    private function lebronJames(): void
    {
        $this->seedCharacter('LeBron James', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a athlete?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character LeBron James?',
            'Seu personagem é LeBron James?'
        ));
    }

    private function charlesDoBronx(): void
    {
        $this->seedCharacter('Charles do Bronx', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a athlete?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Charles do Bronx?',
            'Seu personagem é Charles do Bronx?'
        ));
    }

    private function popo(): void
    {
        $this->seedCharacter('Popó', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a athlete?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Popó?',
            'Seu personagem é Popó?'
        ));
    }

    private function gustavoKuerten(): void
    {
        $this->seedCharacter('Gustavo Kuerten', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a athlete?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Gustavo Kuerten?',
            'Seu personagem é Gustavo Kuerten?'
        ));
    }

    private function nelsonPiquet(): void
    {
        $this->seedCharacter('Nelson Piquet', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a athlete?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Nelson Piquet?',
            'Seu personagem é Nelson Piquet?'
        ));
    }

    private function italoFerreira(): void
    {
        $this->seedCharacter('Ítalo Ferreira', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a athlete?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Ítalo Ferreira?',
            'Seu personagem é Ítalo Ferreira?'
        ));
    }

    private function daianeDosSantos(): void
    {
        $this->seedCharacter('Daiane dos Santos', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a athlete?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Daiane dos Santos?',
            'Seu personagem é Daiane dos Santos?'
        ));
    }

    private function cesarCielo(): void
    {
        $this->seedCharacter('César Cielo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a athlete?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character César Cielo?',
            'Seu personagem é César Cielo?'
        ));
    }

    private function cleberMachado(): void
    {
        $this->seedCharacter('Cléber Machado', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a athlete?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Cléber Machado?',
            'Seu personagem é Cléber Machado?'
        ));
    }

    private function gaules(): void
    {
        $this->seedCharacter('Gaules', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character known for large follower counts?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Gaules?',
            'Seu personagem é Gaules?'
        ));
    }

    private function tancredoNeves(): void
    {
        $this->seedCharacter('Tancredo Neves', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a politician?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Tancredo Neves?',
            'Seu personagem é Tancredo Neves?'
        ));
    }

    private function domPedroI(): void
    {
        $this->seedCharacter('Dom Pedro I', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a politician?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Dom Pedro I?',
            'Seu personagem é Dom Pedro I?'
        ));
    }

    private function tiradentes(): void
    {
        $this->seedCharacter('Tiradentes', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a politician?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Tiradentes?',
            'Seu personagem é Tiradentes?'
        ));
    }

    private function reiCharlesIii(): void
    {
        $this->seedCharacter('Rei Charles III', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a politician?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Rei Charles III?',
            'Seu personagem é Rei Charles III?'
        ));
    }

    private function duqueDeCaxias(): void
    {
        $this->seedCharacter('Duque de Caxias', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a politician?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Duque de Caxias?',
            'Seu personagem é Duque de Caxias?'
        ));
    }

    private function sobralPinto(): void
    {
        $this->seedCharacter('Sobral Pinto', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a politician?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Sobral Pinto?',
            'Seu personagem é Sobral Pinto?'
        ));
    }

    private function papaFrancisco(): void
    {
        $this->seedCharacter('Papa Francisco', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is religion one of the defining traits of your character?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Papa Francisco?',
            'Seu personagem é Papa Francisco?'
        ));
    }

    private function padreMarceloRossi(): void
    {
        $this->seedCharacter('Padre Marcelo Rossi', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is religion one of the defining traits of your character?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Padre Marcelo Rossi?',
            'Seu personagem é Padre Marcelo Rossi?'
        ));
    }

    private function edirMacedo(): void
    {
        $this->seedCharacter('Edir Macedo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is religion one of the defining traits of your character?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Edir Macedo?',
            'Seu personagem é Edir Macedo?'
        ));
    }

    private function silasMalafaia(): void
    {
        $this->seedCharacter('Silas Malafaia', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is religion one of the defining traits of your character?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Silas Malafaia?',
            'Seu personagem é Silas Malafaia?'
        ));
    }

    private function dalaiLama(): void
    {
        $this->seedCharacter('Dalai Lama', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is religion one of the defining traits of your character?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Dalai Lama?',
            'Seu personagem é Dalai Lama?'
        ));
    }

    private function abilioDiniz(): void
    {
        $this->seedCharacter('Abilio Diniz', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character an investor?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Abilio Diniz?',
            'Seu personagem é Abilio Diniz?'
        ));
    }

    private function luizBarsi(): void
    {
        $this->seedCharacter('Luiz Barsi', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character an investor?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Luiz Barsi?',
            'Seu personagem é Luiz Barsi?'
        ));
    }

    private function warrenBuffett(): void
    {
        $this->seedCharacter('Warren Buffett', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character an investor?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Warren Buffett?',
            'Seu personagem é Warren Buffett?'
        ));
    }

    private function oswaldoCruz(): void
    {
        $this->seedCharacter('Oswaldo Cruz', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character associated with technology?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Oswaldo Cruz?',
            'Seu personagem é Oswaldo Cruz?'
        ));
    }

    private function steveJobs(): void
    {
        $this->seedCharacter('Steve Jobs', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character associated with technology?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Steve Jobs?',
            'Seu personagem é Steve Jobs?'
        ));
    }

    private function markZuckerberg(): void
    {
        $this->seedCharacter('Mark Zuckerberg', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character associated with technology?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Mark Zuckerberg?',
            'Seu personagem é Mark Zuckerberg?'
        ));
    }

    private function billGates(): void
    {
        $this->seedCharacter('Bill Gates', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character associated with technology?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Bill Gates?',
            'Seu personagem é Bill Gates?'
        ));
    }

    private function drauzioVarella(): void
    {
        $this->seedCharacter('Drauzio Varella', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character associated with technology?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Drauzio Varella?',
            'Seu personagem é Drauzio Varella?'
        ));
    }

    private function erickJacquin(): void
    {
        $this->seedCharacter('Erick Jacquin', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a TV host?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Erick Jacquin?',
            'Seu personagem é Erick Jacquin?'
        ));
    }

    private function paolaCarosella(): void
    {
        $this->seedCharacter('Paola Carosella', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a TV host?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Paola Carosella?',
            'Seu personagem é Paola Carosella?'
        ));
    }

    private function henriqueFogaca(): void
    {
        $this->seedCharacter('Henrique Fogaça', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a TV host?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Henrique Fogaça?',
            'Seu personagem é Henrique Fogaça?'
        ));
    }

    private function hebeCamargo(): void
    {
        $this->seedCharacter('Hebe Camargo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a TV host?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Hebe Camargo?',
            'Seu personagem é Hebe Camargo?'
        ));
    }

    private function williamBonner(): void
    {
        $this->seedCharacter('William Bonner', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a TV host?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character William Bonner?',
            'Seu personagem é William Bonner?'
        ));
    }

    private function fatimaBernardes(): void
    {
        $this->seedCharacter('Fátima Bernardes', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a TV host?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Fátima Bernardes?',
            'Seu personagem é Fátima Bernardes?'
        ));
    }

    private function joseLuizDatena(): void
    {
        $this->seedCharacter('José Luiz Datena', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a TV host?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character José Luiz Datena?',
            'Seu personagem é José Luiz Datena?'
        ));
    }

    private function mauricioMaia(): void
    {
        $this->seedCharacter('Mauricio Maia', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character a TV host?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Mauricio Maia?',
            'Seu personagem é Mauricio Maia?'
        ));
    }

    private function wagnerMoura(): void
    {
        $this->seedCharacter('Wagner Moura', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Wagner Moura?',
            'Seu personagem é Wagner Moura?'
        ));
    }

    private function lazaroRamos(): void
    {
        $this->seedCharacter('Lázaro Ramos', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Lázaro Ramos?',
            'Seu personagem é Lázaro Ramos?'
        ));
    }

    private function tonyRamos(): void
    {
        $this->seedCharacter('Tony Ramos', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Tony Ramos?',
            'Seu personagem é Tony Ramos?'
        ));
    }

    private function rodrigoSantoro(): void
    {
        $this->seedCharacter('Rodrigo Santoro', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Rodrigo Santoro?',
            'Seu personagem é Rodrigo Santoro?'
        ));
    }

    private function taisAraujo(): void
    {
        $this->seedCharacter('Taís Araújo', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Taís Araújo?',
            'Seu personagem é Taís Araújo?'
        ));
    }

    private function camilaPitanga(): void
    {
        $this->seedCharacter('Camila Pitanga', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Camila Pitanga?',
            'Seu personagem é Camila Pitanga?'
        ));
    }

    private function zecaPagodinho(): void
    {
        $this->seedCharacter('Zeca Pagodinho', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Zeca Pagodinho?',
            'Seu personagem é Zeca Pagodinho?'
        ));
    }

    private function fernandoMeirelles(): void
    {
        $this->seedCharacter('Fernando Meirelles', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Fernando Meirelles?',
            'Seu personagem é Fernando Meirelles?'
        ));
    }

    private function walterSalles(): void
    {
        $this->seedCharacter('Walter Salles', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Walter Salles?',
            'Seu personagem é Walter Salles?'
        ));
    }

    private function chicoAnysio(): void
    {
        $this->seedCharacter('Chico Anysio', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Chico Anysio?',
            'Seu personagem é Chico Anysio?'
        ));
    }

    private function renatoAragao(): void
    {
        $this->seedCharacter('Renato Aragão', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Renato Aragão?',
            'Seu personagem é Renato Aragão?'
        ));
    }

    private function tirullipa(): void
    {
        $this->seedCharacter('Tirullipa', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Tirullipa?',
            'Seu personagem é Tirullipa?'
        ));
    }

    private function fabioPorchat(): void
    {
        $this->seedCharacter('Fábio Porchat', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Fábio Porchat?',
            'Seu personagem é Fábio Porchat?'
        ));
    }

    private function pauloCoelho(): void
    {
        $this->seedCharacter('Paulo Coelho', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Paulo Coelho?',
            'Seu personagem é Paulo Coelho?'
        ));
    }

    private function carlosDrummondDeAndrade(): void
    {
        $this->seedCharacter('Carlos Drummond de Andrade', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Carlos Drummond de Andrade?',
            'Seu personagem é Carlos Drummond de Andrade?'
        ));
    }

    private function viniciusDeMoraes(): void
    {
        $this->seedCharacter('Vinicius de Moraes', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Vinicius de Moraes?',
            'Seu personagem é Vinicius de Moraes?'
        ));
    }

    private function ceciliaMeireles(): void
    {
        $this->seedCharacter('Cecília Meireles', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Cecília Meireles?',
            'Seu personagem é Cecília Meireles?'
        ));
    }

    private function tarsilaDoAmaral(): void
    {
        $this->seedCharacter('Tarsila do Amaral', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Tarsila do Amaral?',
            'Seu personagem é Tarsila do Amaral?'
        ));
    }

    private function candidoPortinari(): void
    {
        $this->seedCharacter('Cândido Portinari', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Cândido Portinari?',
            'Seu personagem é Cândido Portinari?'
        ));
    }

    private function aleijadinho(): void
    {
        $this->seedCharacter('Aleijadinho', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Aleijadinho?',
            'Seu personagem é Aleijadinho?'
        ));
    }

    private function victorBrecheret(): void
    {
        $this->seedCharacter('Victor Brecheret', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Victor Brecheret?',
            'Seu personagem é Victor Brecheret?'
        ));
    }

    private function sebastiaoSalgado(): void
    {
        $this->seedCharacter('Sebastião Salgado', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Sebastião Salgado?',
            'Seu personagem é Sebastião Salgado?'
        ));
    }

    private function alok(): void
    {
        $this->seedCharacter('Alok', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Alok?',
            'Seu personagem é Alok?'
        ));
    }

    private function vintageCulture(): void
    {
        $this->seedCharacter('Vintage Culture', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Vintage Culture?',
            'Seu personagem é Vintage Culture?'
        ));
    }

    private function adrianaLima(): void
    {
        $this->seedCharacter('Adriana Lima', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Adriana Lima?',
            'Seu personagem é Adriana Lima?'
        ));
    }

    private function oskarMetsavaht(): void
    {
        $this->seedCharacter('Oskar Metsavaht', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Oskar Metsavaht?',
            'Seu personagem é Oskar Metsavaht?'
        ));
    }

    private function davidCopperfield(): void
    {
        $this->seedCharacter('David Copperfield', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character David Copperfield?',
            'Seu personagem é David Copperfield?'
        ));
    }

    private function carlinhosDeJesus(): void
    {
        $this->seedCharacter('Carlinhos de Jesus', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character active in music?' => 2,
            'Is your character Brazilian?' => 2,
        ], $this->signature(
            'Is your character Carlinhos de Jesus?',
            'Seu personagem é Carlinhos de Jesus?'
        ));
    }

    private function papaLeguas(): void
    {
        $this->seedCharacter('Papa-Léguas', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character primarily a protagonist?' => 2,
            'Is your character from a comedy?' => 2,
            'Does your character appear in slapstick humor?' => 2,
            'Is your character anthropomorphic?' => 2,
            'Did your character become famous in the 1940s?' => 2,
        ], $this->signature(
            'Is your character always too fast for the Coyote?',
            'Seu personagem é sempre rápido demais para o Coiote?'
        ));
    }

    private function coiote(): void
    {
        $this->seedCharacter('Coiote', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from an animated show or movie?' => 2,
            'Is your character from a comedy?' => 2,
            'Does your character appear in slapstick humor?' => 2,
            'Is your character anthropomorphic?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Did your character become famous in the 1940s?' => 2,
        ], $this->signature(
            'Does your character buy gadgets from ACME to catch a roadrunner?',
            'Seu personagem compra gadgets da ACME para pegar um papa-léguas?'
        ));
    }

    private function r2d2(): void
    {
        $this->seedCharacter('R2-D2', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a science fiction setting?' => 2,
            'Is your character from the Star Wars saga?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character linked to space travel?' => 2,
            'Is your character linked to advanced technology?' => 2,
            'Did your character become famous in the 1970s?' => 2,
        ], $this->signature(
            'Is your character an astromech droid?',
            'Seu personagem é um droide astromecânico?'
        ));
    }

    private function c3po(): void
    {
        $this->seedCharacter('C-3PO', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_ALIVE, 2],

            'Is your character from a science fiction setting?' => 2,
            'Is your character from the Star Wars saga?' => 2,
            [SecondaryAttribute::ALIGNMENT_HEROIC, 2],
            'Is your character linked to space travel?' => 2,
            'Is your character linked to advanced technology?' => 2,
            'Did your character become famous in the 1970s?' => 2,
        ], $this->signature(
            'Is your character a protocol droid fluent in over six million languages?',
            'Seu personagem é um droide de protocolo fluente em mais de seis milhões de idiomas?'
        ));
    }

    private function kyloRen(): void
    {
        $this->seedCharacter('Kylo Ren', [
            [InitialAttribute::AGE_ADULT, 2],
            [InitialAttribute::GENDER_MALE, 2],
            [InitialAttribute::NATIONALITY_FICTICIONAL, 2],
            [InitialAttribute::LIVING_DECEASED, 2],

            'Is your character from a science fiction setting?' => 2,
            'Is your character from the Star Wars saga?' => 2,
            'Is your character primarily a protagonist?' => 2,
            [SecondaryAttribute::ALIGNMENT_VILLAINOUS, 2],
            'Is your character primarily an antagonist?' => 2,
            'Does your character carry a signature weapon?' => 2,
            'Is your character linked to space travel?' => 2,
            'Did your character become famous in the 2010s?' => 2,
        ], $this->signature(
            'Is your character the grandson of Darth Vader?',
            'Seu personagem é neto de Darth Vader?'
        ));
    }
}

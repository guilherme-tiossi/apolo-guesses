<?php

namespace Database\Seeders;

use App\Core\Domain\Attributes\Enums\AttributeSubgroup;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $this->appearance();
        $this->identity();
        $this->personality();
        $this->career();
        $this->sports();
        $this->entertainment();
        $this->hobbies();
        $this->accomplishments();
        $this->history();
        $this->geography();
        $this->technology();
        $this->fiction();
        $this->powers();
        $this->miscellaneous();
    }

    private function seed(array $attributes): void
    {
        foreach ($attributes as $attribute) {
            DB::table('attributes')->updateOrInsert(
                [
                    'attribute_subgroup_id' => $attribute['attribute_subgroup_id'],
                    'question' => $attribute['question'],
                ],
                [
                    'portuguese_question' => $attribute['portuguese_question'],
                    'is_initial_question' => $attribute['is_initial_question'],
                    'is_secondary_question' => $attribute['is_secondary_question'],
                    'internal_name' => $attribute['internal_name'],
                ]
            );
        }
    }

    private function template(
        AttributeSubgroup $subgroup,
        string $questionTemplate,
        string $portugueseTemplate,
        array $traits
    ): array {
        return array_map(function (array $trait) use ($subgroup, $questionTemplate, $portugueseTemplate) {
            [
                'is_initial_question' => $isInitialQuestion,
                'is_secondary_question' => $isSecondaryQuestion,
                'internal_name' => $internalName,
            ] = $this->parseTraitFlags($trait);

            return [
                'attribute_subgroup_id' => $subgroup->value,
                'question' => sprintf($questionTemplate, $trait[0]),
                'portuguese_question' => sprintf($portugueseTemplate, $trait[1]),
                'is_initial_question' => $isInitialQuestion,
                'is_secondary_question' => $isSecondaryQuestion,
                'internal_name' => $internalName,
            ];
        }, $traits);
    }

    private function parseTraitFlags(array $trait): array
    {
        $isInitialQuestion = false;
        $isSecondaryQuestion = false;
        $internalName = null;

        foreach (array_slice($trait, 2) as $flag) {
            if ($flag instanceof InitialAttribute) {
                $isInitialQuestion = true;
                $internalName = $flag->value;
            }

            if ($flag instanceof SecondaryAttribute) {
                $isSecondaryQuestion = true;
                $internalName = $flag->value;
            }

            if (is_bool($flag)) {
                $isInitialQuestion = $flag;
            }
        }

        return [
            'is_initial_question' => $isInitialQuestion,
            'is_secondary_question' => $isSecondaryQuestion,
            'internal_name' => $internalName,
        ];
    }

    private function appearance(): void
    {
        $groups = [
            [AttributeSubgroup::HEIGHT, 'Is your character %s?', 'Seu personagem é %s?', [
                ['very tall', 'muito alto'],
                ['short', 'baixo'],
                ['above average height', 'acima da média de altura'],
                ['below average height', 'abaixo da média de altura'],
                ['known for their height', 'conhecido pela altura'],
                ['around medium height', 'tem altura média'],
                ['considered giant-sized', 'considerado gigante'],
                ['petite', 'de estatura pequena'],
                ['physically imposing in height', 'impõe respeito pela altura'],
                ['described as towering', 'descrito como altíssimo'],
            ]],
            [AttributeSubgroup::WEIGHT, 'Does your character look %s?', 'Seu personagem parece %s?', [
                ['very slim', 'muito magro'],
                ['chubby', 'gordinho'],
                ['athletically lean', 'atlético e seco'],
                ['heavyset', 'mais pesado'],
                ['fit and balanced', 'em forma e equilibrado'],
                ['underweight', 'abaixo do peso'],
                ['stocky', 'encorpado'],
                ['muscular and heavy', 'musculoso e pesado'],
                ['lightweight', 'leve fisicamente'],
                ['broad and solid', 'largo e robusto'],
            ]],
            [AttributeSubgroup::BUILD, 'Does your character have a %s build?', 'Seu personagem tem porte %s?', [
                ['muscular', 'musculoso'],
                ['slim', 'magro'],
                ['athletic', 'atlético'],
                ['stocky', 'encorpado'],
                ['fragile', 'frágil'],
                ['broad-shouldered', 'de ombros largos'],
                ['thin', 'fino'],
                ['powerful', 'forte'],
                ['average', 'mediano'],
                ['bodybuilder-like', 'de fisiculturista'],
            ]],
            [AttributeSubgroup::SKIN_COLOR, 'Does your character have %s skin?', 'Seu personagem tem pele %s?', [
                ['fair', 'clara', InitialAttribute::SKIN_FAIR],
                ['dark', 'escura', InitialAttribute::SKIN_DARK],
                ['brown', 'morena'],
                ['very pale', 'muito pálida'],
                ['tan', 'bronzeada'],
                ['olive', 'oliva'],
                ['golden', 'dourada'],
                ['reddish', 'avermelhada'],
                ['freckled', 'com sardas'],
                ['a fantasy-colored', 'de cor fantasiosa'],
            ]],
            [AttributeSubgroup::HAIR_COLOR, 'Does your character have %s hair?', 'Seu personagem tem cabelo %s?', [
                ['black', 'preto'],
                ['brown', 'castanho'],
                ['blond', 'loiro'],
                ['red', 'ruivo'],
                ['white', 'branco'],
                ['gray', 'grisalho'],
                ['blue', 'azul'],
                ['green', 'verde'],
                ['pink', 'rosa'],
                ['dyed in unusual colors', 'tingido em cores incomuns'],
            ]],
            [AttributeSubgroup::HAIR_LENGTH, 'Does your character have %s hair?', 'Seu personagem tem cabelo %s?', [
                ['very short', 'muito curto'],
                ['short', 'curto'],
                ['medium-length', 'médio'],
                ['long', 'longo'],
                ['very long', 'muito longo'],
                ['shoulder-length', 'na altura dos ombros'],
                ['waist-length', 'na cintura'],
                ['buzz cut', 'raspado'],
                ['partially shaved', 'parcialmente raspado'],
                ['usually tied up due to length', 'geralmente preso por ser longo'],
            ]],
            [AttributeSubgroup::HAIR_STYLE, 'Does your character wear a %s hairstyle?', 'Seu personagem usa penteado %s?', [
                ['ponytail', 'rabo de cavalo'],
                ['braided', 'trancado'],
                ['spiky', 'arrepiado'],
                ['curtain bangs', 'com franja dividida'],
                ['undercut', 'undercut'],
                ['mohawk', 'moicano'],
                ['afro', 'afro'],
                ['messy', 'bagunçado'],
                ['slicked back', 'penteado para trás'],
                ['iconic signature hairstyle', 'marcante e assinatura'],
            ]],
            [AttributeSubgroup::HAIR_TEXTURE, 'Is your character hair texture %s?', 'A textura do cabelo do seu personagem é %s?', [
                ['straight', 'lisa', InitialAttribute::HAIR_STRAIGHT],
                ['wavy', 'ondulada', InitialAttribute::HAIR_WAVY],
                ['curly', 'cacheada', InitialAttribute::HAIR_CURLY],
                ['coily', 'crespa', InitialAttribute::HAIR_COILY],
                ['frizzy', 'arrepiada'],
                ['visibly voluminous', 'bem volumosa'],
            ]],
            [AttributeSubgroup::FACIAL_HAIR, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['a full beard', 'barba cheia'],
                ['a moustache', 'bigode'],
                ['a goatee', 'cavanhaque'],
                ['stubble', 'barba por fazer'],
                ['sideburns', 'costeletas'],
                ['a styled beard', 'barba estilizada'],
                ['a shaved face', 'rosto sem barba'],
                ['patchy facial hair', 'pelos faciais falhados'],
                ['a long beard', 'barba longa'],
                ['facial hair as a trademark', 'barba como marca registrada'],
            ]],
            [AttributeSubgroup::EYE_COLOR, 'Does your character have %s eyes?', 'Seu personagem tem olhos %s?', [
                ['brown', 'castanhos'],
                ['blue', 'azuis'],
                ['green', 'verdes'],
                ['hazel', 'cor de mel'],
                ['gray', 'cinzas'],
                ['black', 'pretos'],
                ['amber', 'âmbar'],
                ['heterochromia', 'de cores diferentes'],
                ['glowing', 'brilhantes'],
                ['unusually colored', 'de cor incomum'],
            ]],
            [AttributeSubgroup::FACIAL_FEATURES, 'Is your character known for %s?', 'Seu personagem é conhecido por %s?', [
                ['a sharp jawline', 'um maxilar marcante'],
                ['high cheekbones', 'maçãs do rosto altas'],
                ['a round face', 'rosto redondo'],
                ['a long face', 'rosto alongado'],
                ['a prominent nose', 'nariz destacado'],
                ['thick eyebrows', 'sobrancelhas grossas'],
                ['dimples', 'covinhas'],
                ['a scar on the face', 'cicatriz no rosto'],
                ['a very expressive face', 'expressão facial muito forte'],
                ['a memorable smile', 'sorriso marcante'],
            ]],
            [AttributeSubgroup::SPECIES, 'Is your character %s?', 'Seu personagem é %s?', [
                ['human', 'humano'],
                ['alien', 'alienígena'],
                ['android', 'androide'],
                ['mutant', 'mutante'],
                ['vampire', 'vampiro'],
                ['werewolf', 'lobisomem'],
                ['godlike being', 'uma entidade divina'],
                ['animal-like', 'semelhante a um animal'],
                ['robotic', 'robótico'],
                ['mythological creature', 'criatura mitológica'],
            ]],
            [AttributeSubgroup::STYLE, 'Does your character usually wear a %s style?', 'Seu personagem geralmente usa estilo %s?', [
                ['casual', 'casual'],
                ['formal', 'formal'],
                ['sporty', 'esportivo'],
                ['elegant', 'elegante'],
                ['streetwear', 'de rua'],
                ['traditional', 'tradicional'],
                ['armor-based', 'com armadura'],
                ['gothic', 'gótico'],
                ['minimalist', 'minimalista'],
                ['very flashy', 'bem chamativo'],
            ]],
            [AttributeSubgroup::DISABILITIES, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['a visual impairment', 'deficiência visual'],
                ['a hearing impairment', 'deficiência auditiva'],
                ['limited mobility', 'mobilidade reduzida'],
                ['a prosthetic limb', 'prótese'],
                ['a speech impairment', 'deficiência na fala'],
                ['chronic pain', 'dor crônica'],
                ['neurodivergent traits', 'traços neurodivergentes'],
                ['a permanent injury', 'lesão permanente'],
                ['a condition requiring assistance devices', 'condição que exige dispositivo de apoio'],
                ['a disability represented in their story', 'deficiência relevante na história'],
            ]],
            [AttributeSubgroup::DISTINCTIVE_FEATURES, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['a visible tattoo', 'tatuagem visível'],
                ['a unique scar', 'cicatriz única'],
                ['piercings', 'piercings'],
                ['a birthmark', 'marca de nascimento'],
                ['a robotic arm', 'braço robótico'],
                ['a mask', 'máscara'],
                ['a cape', 'capa'],
                ['a signature accessory', 'acessorio marcante'],
                ['unusual glowing marks', 'marcas brilhantes incomuns'],
                ['an iconic silhouette', 'silhueta icônica'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function identity(): void
    {
        $groups = [
            [AttributeSubgroup::AGE, 'Is your character %s?', 'Seu personagem %s?', [
                ['a child', 'é criança', InitialAttribute::AGE_CHILD],
                ['a teenager', 'é adolescente', InitialAttribute::AGE_TEENAGER],
                ['an adult', 'é adulto', InitialAttribute::AGE_ADULT],
                ['over forty', 'está acima dos quarenta', InitialAttribute::AGE_OVER_FORTY],
                ['elderly', 'é idoso', InitialAttribute::AGE_ELDERLY],
                ['ageless', 'parece sem idade'],
            ]],
            [AttributeSubgroup::GENDER, 'Is your character %s?', 'Seu personagem %s?', [
                ['male', 'é homem', InitialAttribute::GENDER_MALE],
                ['female', 'é mulher', InitialAttribute::GENDER_FEMALE],
                ['non-binary', 'é não binário'],
                ['gender-fluid', 'é gênero fluido'],
                ['androgynous', 'é andrógino'],
                ['transgender', 'é transgênero'],
                ['cisgender', 'é cisgênero'],
                ['openly discussing gender identity', 'fala abertamente sobre identidade de gênero'],
                ['recognized by a specific gender identity in canon', 'é reconhecido por identidade de gênero específica no canon'],
            ]],
            [AttributeSubgroup::SEXUAL_ORIENTATION, 'Is your character %s?', 'Seu personagem %s?', [
                ['heterosexual', 'é heterossexual'],
                ['homosexual', 'é homossexual'],
                ['bisexual', 'é bissexual'],
                ['asexual', 'é assexual'],
                ['pansexual', 'é pansexual'],
                ['queer', 'é queer'],
                ['demisexual', 'é demissexual'],
                ['orientation openly addressed in story', 'tem orientação tratada abertamente na história'],
                ['known for significant romantic relationships', 'é conhecido por relacionamentos românticos marcantes'],
            ]],
            [AttributeSubgroup::NATIONALITY, 'Is your character %s?', 'Seu personagem %s?', [
                ['Brazilian', 'é brasileiro', InitialAttribute::NATIONALITY_BRAZILIAN],
                ['American', 'é americano'],
                ['Japanese', 'é japonês'],
                ['British', 'é britânico'],
                ['French', 'é francês'],
                ['German', 'é alemão'],
                ['Italian', 'é italiano'],
                ['Spanish', 'é espanhol'],
                ['from multiple national backgrounds', 'tem múltiplas nacionalidades'],
                ['nationality central to their identity', 'tem nacionalidade central na identidade'],
                ['fictional', 'é fictício', InitialAttribute::NATIONALITY_FICTICIONAL],
            ]],
            [AttributeSubgroup::ETHNICITY, 'Is your character described as %s?', 'Seu personagem é descrito como %s?', [
                ['black', 'negro'],
                ['white', 'branco'],
                ['asian', 'asiático'],
                ['latino', 'latino'],
                ['indigenous', 'indígena'],
                ['mixed ethnicity', 'etnia mista'],
                ['middle eastern', 'do oriente médio'],
                ['ethnicity discussed in story', 'etnia discutida na história'],
                ['from a minority ethnic group', 'de um grupo étnico minoritário'],
                ['ethnically ambiguous', 'etnicamente ambíguo'],
            ]],
            [AttributeSubgroup::LANGUAGES, 'Does your character %s?', 'Seu personagem %s?', [
                ['speak more than one language', 'fala mais de um idioma'],
                ['speak Portuguese', 'fala português'],
                ['speak English', 'fala inglês'],
                ['speak Spanish', 'fala espanhol'],
                ['speak Japanese', 'fala japonês'],
                ['speak with a strong accent', 'fala com sotaque forte'],
                ['use sign language', 'usa linguagem de sinais'],
                ['switch languages often', 'troca de idioma com frequência'],
                ['have a famous catchphrase in another language', 'tem frase marcante em outro idioma'],
                ['communicate telepathically instead of speaking', 'se comunica telepaticamente em vez de falar'],
            ]],
            [AttributeSubgroup::IDENTITY_TITLES, 'Is your character known as %s?', 'Seu personagem é conhecido como %s?', [
                ['a king or queen', 'rei ou rainha'],
                ['a captain', 'capitão'],
                ['a professor', 'professor'],
                ['a doctor', 'doutor'],
                ['a commander', 'comandante'],
                ['a master', 'mestre'],
                ['a president', 'presidente'],
                ['a saint or prophet', 'santo ou profeta'],
                ['a hero title holder', 'detentor de título heroico'],
                ['a legendary title bearer', 'portador de título lendário'],
            ]],
            [AttributeSubgroup::LIVING_STATUS, 'Is your character %s?', 'Seu personagem %s?', [
                ['alive', 'está vivo', InitialAttribute::LIVING_ALIVE],
                ['deceased', 'está morto', InitialAttribute::LIVING_DECEASED],
                ['resurrected', 'já ressuscitou'],
                ['undead', 'é morto-vivo'],
                ['missing', 'está desaparecido'],
                ['presumed dead', 'foi dado como morto'],
                ['immortal', 'é imortal'],
                ['frozen in time', 'está congelado no tempo'],
                ['from a past timeline', 'vem de uma linha temporal passada'],
                ['alive only in flashbacks or memories', 'aparece vivo apenas em lembranças'],
            ]],
            [AttributeSubgroup::BIRTH_ORIGIN, 'Was your character born %s?', 'Seu personagem nasceu %s?', [
                ['in Brazil', 'no Brasil'],
                ['in the United States', 'nos Estados Unidos'],
                ['in Europe', 'na Europa'],
                ['in Ásia', 'na Ásia'],
                ['in a fictional world', 'em um mundo fictício'],
                ['in outer space', 'no espaco'],
                ['in a royal family', 'em familia real'],
                ['in a poor family', 'em familia pobre'],
                ['in extraordinary circumstances', 'em circunstâncias extraordinárias'],
                ['with a mysterious origin', 'com origem misteriosa'],
            ]],
            [AttributeSubgroup::RELIGION, 'Is religion important to your character?', 'A religião é importante para o seu personagem?', [
                ['', '', SecondaryAttribute::RELIGION_IMPORTANT], // validar
            ]],
            [AttributeSubgroup::RELIGION, 'Does your character identify as %s?', 'Seu personagem se identifica como %s?', [
                ['Christian', 'cristao', SecondaryAttribute::RELIGION_CHRISTIAN],
                ['Muslim', 'muçulmano', SecondaryAttribute::RELIGION_MUSLIM],
                ['Jewish', 'judeu', SecondaryAttribute::RELIGION_JEWISH],
                ['Buddhist', 'budista', SecondaryAttribute::RELIGION_BUDDHIST],
                ['atheist', 'ateu', SecondaryAttribute::RELIGION_ATHEIST],
                ['agnostic', 'agnóstico', SecondaryAttribute::RELIGION_AGNOSTIC],
                ['spiritual but not religious', 'espiritual mas não religioso'],
                ['from a fictional religion', 'de religião fictícia'],
                ['deeply religious', 'muito religioso'],
                ['religion influences major choices', 'tem religião influenciando decisões'],
            ]],
            [AttributeSubgroup::FAMILY, 'Does your character %s?', 'Seu personagem %s?', [
                ['have siblings', 'tem irmaos'],
                ['have children', 'tem filhos'],
                ['come from a famous family', 'vem de familia famosa'],
                ['have a complicated family history', 'tem história familiar complicada'],
                ['have lost a parent early', 'perdeu um dos pais cedo'],
                ['protect their family at all costs', 'protege a familia a qualquer custo'],
                ['have an absent family', 'tem familia ausente'],
                ['have a mentor as a family figure', 'tem mentor como figura familiar'],
                ['have a rival inside the family', 'tem rival dentro da familia'],
                ['family is central to the story', 'tem familia como parte central da história'],
            ]],
            [AttributeSubgroup::POLITICAL_PROFILE, 'Is your character %s?', 'Seu personagem %s?', [
                ['politically active', 'é politicamente ativo'],
                ['neutral in politics', 'é neutro em política'],
                ['a government supporter', 'apoia o governo'],
                ['a rebel against authority', 'é rebelde contra autoridade'],
                ['an activist', 'é ativista'],
                ['a revolutionary', 'é revolucionário'],
                ['a conservative figure', 'é figura conservadora', SecondaryAttribute::POLITICAL_CONSERVATIVE],
                ['a progressive figure', 'é figura progressista', SecondaryAttribute::POLITICAL_PROGRESSIVE],
                ['publicly influential in politics', 'tem influência pública na política'],
                ['involved in political controversy', 'está envolvido em controversia política'],
            ]],
            [AttributeSubgroup::EDUCATION, 'Does your character %s?', 'Seu personagem %s?', [
                ['have a university degree', 'tem diploma universitário'],
                ['have formal military training', 'tem treinamento militar formal'],
                ['be self-taught', 'é autodidata'],
                ['have incomplete formal education', 'tem educação formal incompleta'],
                ['study science', 'estuda ciências'],
                ['study arts', 'estuda artes'],
                ['study law', 'estuda direito'],
                ['study medicine', 'estuda medicina'],
                ['be known for genius-level learning', 'é conhecido por aprendizado genial'],
                ['learn through real-world experience', 'aprende pela experiencia pratica'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function personality(): void
    {
        $groups = [
            [AttributeSubgroup::TEMPERAMENT, 'Is your character %s?', 'Seu personagem %s?', [
                ['calm', 'é calmo'],
                ['aggressive', 'é agressivo'],
                ['patient', 'é paciente'],
                ['impulsive', 'é impulsivo'],
                ['hot-tempered', 'tem temperamento explosivo'],
                ['composed under pressure', 'mantem controle sob pressao'],
                ['emotionally distant', 'é emocionalmente distante'],
                ['warm and friendly', 'é caloroso e amigável'],
            ]],
            [AttributeSubgroup::INTELLIGENCE, 'Is your character %s?', 'Seu personagem %s?', [
                ['a genius', 'é um gênio'],
                ['analytical', 'é analítico'],
                ['street-smart', 'é esperto na pratica'],
                ['book-smart', 'é muito estudioso'],
                ['strategic', 'é estrategista'],
                ['inventive', 'é inventivo'],
                ['naive', 'é ingênuo'],
                ['known for solving complex problems', 'é conhecido por resolver problemas complexos'],
            ]],
            [AttributeSubgroup::HUMOR, 'Does your character %s?', 'Seu personagem %s?', [
                ['make jokes often', 'faz piadas com frequência'],
                ['have sarcastic humor', 'tem humor sarcástico'],
                ['have dark humor', 'tem humor sombrio'],
                ['have childish humor', 'tem humor infantil'],
                ['rarely joke', 'raramente brinca'],
                ['use humor to cope', 'usa humor para lidar com problemas'],
                ['laugh loudly', 'ri alto'],
                ['be known for witty lines', 'é conhecido por frases espirituosas'],
            ]],
            [AttributeSubgroup::LEADERSHIP, 'Does your character %s?', 'Seu personagem %s?', [
                ['lead a team', 'lidera um time'],
                ['prefer to work alone', 'prefere trabalhar sozinho'],
                ['inspire others', 'inspira os outros'],
                ['take command in crisis', 'assume comando em crises'],
                ['avoid responsibility', 'evita responsabilidade'],
                ['act as second-in-command', 'atua como segundo no comando'],
                ['have followers', 'tem seguidores'],
                ['struggle with leadership', 'tem dificuldade em lideranca'],
            ]],
            [AttributeSubgroup::MORALITY, 'Is your character %s?', 'Seu personagem %s?', [
                ['morally upright', 'é moralmente correto'],
                ['morally gray', 'é moralmente cinza'],
                ['selfish', 'é egoísta'],
                ['self-sacrificing', 'se sacrifica pelos outros'],
                ['rule-breaking', 'quebra regras'],
                ['justice-driven', 'é movido por justiça'],
                ['vengeful', 'é vingativo'],
                ['forgiving', 'é perdoador'],
            ]],
            [AttributeSubgroup::HEALTH, 'Does your character %s?', 'Seu personagem %s?', [
                ['have excellent health', 'tem saúde excelente'],
                ['have a chronic illness', 'tem doença crônica'],
                ['recover quickly', 'se recupera rapido'],
                ['have low stamina', 'tem baixa resistência'],
                ['need medication', 'precisa de medicação'],
                ['have enhanced healing', 'tem cura acelerada'],
                ['struggle with injuries', 'sofre com lesões'],
                ['maintain strict physical care', 'mantem cuidados fisicos rigorosos'],
            ]],
            [AttributeSubgroup::EMOTIONS, 'Does your character %s?', 'Seu personagem %s?', [
                ['show emotions openly', 'mostra emocoes abertamente'],
                ['hide emotions', 'esconde emocoes'],
                ['cry easily', 'chora facilmente'],
                ['keep a stoic face', 'mantem rosto estoico'],
                ['act out of fear', 'age por medo'],
                ['act out of love', 'age por amor'],
                ['hold grudges', 'guarda rancor'],
                ['forgive quickly', 'perdoa rapido'],
            ]],
            [AttributeSubgroup::HABITS, 'Does your character %s?', 'Seu personagem %s?', [
                ['train daily', 'treina diariamente'],
                ['drink coffee often', 'bebe cafe com frequência'],
                ['smoke', 'fuma'],
                ['keep a journal', 'mantem diario'],
                ['arrive late', 'chega atrásado'],
                ['follow strict routines', 'segue rotinas rigorosas'],
                ['bite their nails', 'roe unhas'],
                ['collect small objects compulsively', 'coleciona pequenos objetos compulsivamente'],
            ]],
            [AttributeSubgroup::LIFESTYLE, 'Does your character live a %s lifestyle?', 'Seu personagem vive um estilo de vida %s?', [
                ['luxurious', 'luxuoso'],
                ['simple', 'simples'],
                ['nomadic', 'nomade'],
                ['urban', 'urbano'],
                ['rural', 'rural'],
                ['secretive', 'secreto'],
                ['dangerous', 'perigoso'],
                ['disciplined', 'disciplinado'],
            ]],
            [AttributeSubgroup::BELIEFS, 'Does your character believe in %s?', 'Seu personagem acredita em %s?', [
                ['fate', 'destino'],
                ['science above superstition', 'ciencia acima de supersticao'],
                ['justice above law', 'justiça acima da lei'],
                ['redemption for everyone', 'redencao para todos'],
                ['strength as the highest value', 'força como valor máximo'],
                ['peace over conflict', 'paz acima de conflito'],
                ['tradition', 'tradicao'],
                ['personal freedom above all', 'liberdade pessoal acima de tudo'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function career(): void
    {
        $groups = [
            [AttributeSubgroup::PROFESSION, 'Is your character a %s?', 'Seu personagem é %s?', [
                ['athlete', 'atleta'],
                ['actor', 'ator'],
                ['singer', 'cantor'],
                ['politician', 'político'],
                ['scientist', 'cientista'],
                ['doctor', 'médico'],
                ['lawyer', 'advogado'],
                ['teacher', 'professor'],
            ]],
            [AttributeSubgroup::INDUSTRY, 'Does your character work in %s?', 'Seu personagem trabalha com %s?', [
                ['sports', 'esportes'],
                ['entertainment', 'entretenimento'],
                ['technology', 'tecnologia'],
                ['healthcare', 'saúde'],
                ['law and justice', 'direito e justiça'],
                ['public administration', 'administração pública'],
                ['military operations', 'operações militares'],
                ['education', 'educação'],
            ]],
            [AttributeSubgroup::ARTS, 'Is your character active in %s?', 'Seu personagem atua em %s?', [
                ['music', 'música'],
                ['cinema', 'cinema'],
                ['painting', 'pintura'],
                ['dance', 'dança'],
                ['theater', 'teatro'],
                ['literature', 'literatura'],
                ['fashion', 'moda'],
                ['photography', 'fotografia'],
            ]],
            [AttributeSubgroup::SCIENCE, 'Is your character involved with %s?', 'Seu personagem está envolvido com %s?', [
                ['physics', 'física'],
                ['chemistry', 'química'],
                ['biology', 'biologia'],
                ['astronomy', 'astronomia'],
                ['engineering', 'engenharia'],
                ['research labs', 'laboratórios de pesquisa'],
                ['scientific innovation', 'inovação científica'],
                ['academic publication', 'publicação acadêmica'],
            ]],
            [AttributeSubgroup::BUSINESS, 'Does your character %s?', 'Seu personagem %s?', [
                ['own a company', 'é dono de empresa'],
                ['run a startup', 'comanda uma startup'],
                ['invest in businesses', 'investe em negocios'],
                ['work in finance', 'atua em finanças'],
                ['manage large teams', 'gerencia equipes grandes'],
                ['focus on sales', 'foca em vendas'],
                ['build global brands', 'constroi marcas globais'],
                ['make high-risk deals', 'faz acordos de alto risco'],
            ]],
            [AttributeSubgroup::MEDICINE, 'Is your character related to %s?', 'Seu personagem está ligado a %s?', [
                ['surgery', 'cirurgia'],
                ['emergency care', 'atendimento de emergência'],
                ['psychiatry', 'psiquiatria'],
                ['pediatrics', 'pediatria'],
                ['public health', 'saúde pública'],
                ['medical research', 'pesquisa medica'],
                ['nursing', 'enfermagem'],
                ['medical ethics', 'etica medica'],
            ]],
            [AttributeSubgroup::LAW, 'Does your character work with %s?', 'Seu personagem trabalha com %s?', [
                ['criminal law', 'direito penal'],
                ['civil law', 'direito civil'],
                ['constitutional law', 'direito constitucional'],
                ['human rights law', 'direitos humanos'],
                ['court trials', 'julgamentos'],
                ['legal defense', 'defesa jurídica'],
                ['law enforcement', 'aplicação da lei'],
                ['legal reforms', 'reformas legais'],
            ]],
            [AttributeSubgroup::MEDIA, 'Does your character work in %s?', 'Seu personagem trabalha com %s?', [
                ['television', 'televisão'],
                ['journalism', 'jornalismo'],
                ['radio', 'radio'],
                ['online digital content', 'conteudo digital online', InitialAttribute::MEDIA_DIGITAL_CONTENT],
                ['podcasts', 'podcasts'],
                ['news reporting', 'reportagem'],
                ['social platforms', 'plataformas sociais'],
                ['documentary production', 'producao de documentários'],
            ]],
            [AttributeSubgroup::PUBLIC_SERVICE, 'Does your character serve in %s?', 'Seu personagem atua em %s?', [
                ['government office', 'cargo publico'],
                ['diplomacy', 'diplomacia'],
                ['public safety', 'segurança pública'],
                ['education policy', 'política educacional'],
                ['health administration', 'administração de saude'],
                ['community leadership', 'lideranca comunitaria'],
                ['social programs', 'programas sociais'],
                ['international organizations', 'organizacoes internacionais'],
            ]],
            [AttributeSubgroup::MILITARY_CAREER, 'Does your character have a %s military profile?', 'Seu personagem tem perfil militar %s?', [
                ['active combat', 'de combate ativo'],
                ['strategic command', 'de comando estrategico'],
                ['special forces', 'de forças especiais'],
                ['veteran', 'de veterano'],
                ['military academy', 'de academia militar'],
                ['intelligence operations', 'de operações de inteligencia'],
                ['peacekeeping missions', 'de missao de paz'],
                ['high-ranking officer', 'de alta patente'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function sports(): void
    {
        $groups = [
            [AttributeSubgroup::FOOTBALL, 'Does your character %s?', 'Seu personagem %s?', [
                ['play football professionally', 'joga futebol profissionalmente'],
                ['score many goals', 'marca muitos gols'],
                ['play as a forward', 'joga como atacante'],
                ['play in a famous club', 'joga em clube famoso'],
                ['captain a football team', 'capitaneia um time de futebol'],
                ['be known for dribbling', 'é conhecido por dribles'],
                ['play in international tournaments', 'joga torneios internacionais'],
                ['have football as main identity', 'tem futebol como identidade principal'],
            ]],
            [AttributeSubgroup::BASKETBALL, 'Does your character %s?', 'Seu personagem %s?', [
                ['play basketball professionally', 'joga basquete profissionalmente'],
                ['play in a major league', 'joga em liga principal'],
                ['be known for dunks', 'é conhecido por enterradas'],
                ['play as a point guard', 'joga como armador'],
                ['be very tall for basketball', 'é muito alto para o basquete'],
                ['win basketball championships', 'vence campeonatos de basquete'],
                ['have a signature shooting style', 'tem estilo de arremesso marcante'],
                ['be a basketball icon', 'é ícone do basquete'],
            ]],
            [AttributeSubgroup::OTHER_SPORTS, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['tennis', 'tênis'],
                ['swimming', 'natação'],
                ['surfing', 'surfe'],
                ['athletics', 'atletismo'],
                ['motorsports', 'automobilismo'],
                ['martial arts competitions', 'competicoes marciais'],
                ['olympic events', 'eventos olimpicos'],
                ['extreme sports', 'esportes radicais'],
            ]],
            [AttributeSubgroup::COMBAT_SPORTS, 'Does your character compete in %s?', 'Seu personagem compete em %s?', [
                ['boxing', 'boxe'],
                ['mma', 'mma'],
                ['judo', 'judo'],
                ['wrestling', 'luta livre'],
                ['taekwondo', 'taekwondo'],
                ['karate', 'karate'],
                ['muay thai', 'muay thai'],
                ['high-level combat tournaments', 'torneios de combate de alto nivel'],
            ]],
            [AttributeSubgroup::ESPORTS, 'Does your character %s?', 'Seu personagem %s?', [
                ['compete in esports', 'compete em esports'],
                ['stream gameplay', 'faz transmissao de jogos'],
                ['play shooter games professionally', 'joga jogos de tiro profissionalmente'],
                ['play moba games professionally', 'joga moba profissionalmente'],
                ['lead an esports team', 'lidera um time de esports'],
                ['have esports championships', 'tem titulos em esports'],
                ['be famous in gaming communities', 'é famoso em comunidades de games'],
            ]],
            [AttributeSubgroup::SPORT_ROLES, 'Is your character mainly a %s?', 'Seu personagem é principalmente %s?', [
                ['player', 'jogador'],
                ['coach', 'tecnico'],
                ['team captain', 'capitao de equipe'],
                ['manager', 'gestor esportivo'],
                ['commentator', 'comentarista'],
                ['referee', 'arbitro'],
                ['analyst', 'analista esportivo'],
                ['trainer', 'preparador'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function entertainment(): void
    {
        $groups = [
            [AttributeSubgroup::MOVIES, 'Is your character known for %s?', 'Seu personagem é conhecido por %s?', [
                ['action movies', 'filmes de ação'],
                ['comedy movies', 'filmes de comédia'],
                ['drama movies', 'filmes de drama'],
                ['science-fiction films', 'filmes de ficção científica'],
                ['superhero films', 'filmes de super-heroi'],
                ['award-winning performances', 'atuacoes premiadas'],
                ['movie directing', 'direcao de cinema'],
                ['box-office hits', 'sucessos de bilheteria'],
            ]],
            [AttributeSubgroup::TELEVISION, 'Is your character known in %s?', 'Seu personagem é conhecido na %s?', [
                ['tv series', 'série de TV'],
                ['soap operas', 'novela'],
                ['reality shows', 'reality show'],
                ['talk shows', 'talk show'],
                ['news programs', 'programas jornalísticos'],
                ['sports broadcasting', 'transmissao esportiva'],
                ['children television', 'televisão infantil'],
                ['prime-time shows', 'programas de horario nobre'],
            ]],
            [AttributeSubgroup::MUSIC, 'Is your character linked to %s?', 'Seu personagem está ligado a %s?', [
                ['pop music', 'música pop'],
                ['rock music', 'música rock'],
                ['rap or hip-hop', 'rap ou hip-hop'],
                ['classical music', 'música clássica'],
                ['electronic music', 'música eletrônica'],
                ['live performances', 'apresentações ao vivo'],
                ['songwriting', 'composicao musical'],
                ['chart-topping songs', 'musicas de topo das paradas'],
            ]],
            [AttributeSubgroup::THEATER, 'Does your character have a career in %s?', 'Seu personagem tem carreira em %s?', [
                ['musical theater', 'teatro musical'],
                ['dramatic theater', 'teatro dramatico'],
                ['stage comedy', 'comédia de palco'],
                ['play directing', 'direcao teatral'],
                ['acting schools', 'escolas de atuação'],
                ['broadway-style productions', 'producao estilo broadway'],
                ['classical plays', 'peças clássicas'],
                ['experimental theater', 'teatro experimental'],
            ]],
            [AttributeSubgroup::LITERATURE, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['novels', 'romances'],
                ['poetry', 'poesia'],
                ['fantasy books', 'livros de fantasia'],
                ['historical books', 'livros historicos'],
                ['best-selling books', 'livros best-seller'],
                ['book adaptations', 'adaptações literarias'],
                ['literary awards', 'prêmios literarios'],
                ['writing as profession', 'escrita como profissao'],
            ]],
            [AttributeSubgroup::COMICS, 'Does your character appear in %s?', 'Seu personagem aparece em %s?', [
                ['superhero comics', 'quadrinhos de super-heroi'],
                ['independent comics', 'quadrinhos independentes'],
                ['graphic novels', 'novelas graficas'],
                ['comic crossovers', 'crossovers de quadrinhos'],
                ['comic strips', 'tiras de quadrinhos'],
                ['dark comic universes', 'universos de quadrinhos sombrios'],
                ['classic comic runs', 'sagas clássicas de quadrinhos'],
                ['comic fan culture', 'cultura fandom de quadrinhos'],
            ]],
            [AttributeSubgroup::ANIME_MANGA, 'Is your character from %s?', 'Seu personagem vem de %s?', [
                ['anime', 'anime'],
                ['manga', 'manga'],
                ['shonen stories', 'história shonen'],
                ['seinen stories', 'história seinen'],
                ['isekai worlds', 'mundo isekai'],
                ['mecha franchises', 'franquias mecha'],
                ['classic anime era', 'era clássica dos animes'],
                ['modern anime hits', 'sucessos modernos de anime'],
            ]],
            [AttributeSubgroup::STREAMING, 'Is your character popular on %s?', 'Seu personagem é popular em %s?', [
                ['live streaming platforms', 'plataformas de live'],
                ['video streaming services', 'servicos de streaming de video'],
                ['binge-watch series', 'series maratonaveis'],
                ['streaming originals', 'producoes originais de streaming'],
                ['gaming streams', 'lives de games'],
                ['reaction content', 'conteudo de reação'],
                ['subscription platforms', 'plataformas de assinatura'],
                ['viral clips', 'clipes virais'],
            ]],
            [AttributeSubgroup::SOCIAL_MEDIA, 'Is your character known for %s?', 'Seu personagem é conhecido por %s?', [
                ['viral posts', 'posts virais'],
                ['short videos', 'videos curtos'],
                ['photo content', 'conteudo de fotos'],
                ['controversial online opinions', 'opiniões polêmicas online'],
                ['large follower counts', 'grande numero de seguidores'],
                ['influencer collaborations', 'colaboracoes com influenciadores'],
                ['social media trends', 'tendências de redes sociais'],
                ['memes', 'memes'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function hobbies(): void
    {
        $groups = [
            [AttributeSubgroup::ARTS_AND_CRAFTS, 'Does your character enjoy %s?', 'Seu personagem gosta de %s?', [
                ['painting', 'pintura'],
                ['drawing', 'desenho'],
                ['sculpting', 'escultura'],
                ['handmade crafts', 'artesanato'],
                ['origami', 'origami'],
                ['digital art', 'arte digital'],
                ['calligraphy', 'caligrafia'],
                ['creative DIY projects', 'projetos criativos faca voce mesmo'],
            ]],
            [AttributeSubgroup::COLLECTING, 'Does your character collect %s?', 'Seu personagem coleciona %s?', [
                ['coins', 'moedas'],
                ['stamps', 'selos'],
                ['comics', 'quadrinhos'],
                ['action figures', 'action figures'],
                ['cards', 'cartas'],
                ['rare books', 'livros raros'],
                ['historical artifacts', 'artefatos historicos'],
                ['memorabilia', 'itens de colecao'],
            ]],
            [AttributeSubgroup::TRAVEL, 'Does your character %s?', 'Seu personagem %s?', [
                ['travel frequently', 'viaja com frequência'],
                ['prefer international trips', 'prefere viagens internacionais'],
                ['enjoy road trips', 'gosta de viagens de estrada'],
                ['explore remote places', 'explora lugares remotos'],
                ['travel for work', 'viaja a trabalho'],
                ['document trips', 'documenta viagens'],
                ['seek adventure tourism', 'busca turismo de aventura'],
                ['prefer staying in one place', 'prefere ficar em um lugar'],
            ]],
            [AttributeSubgroup::READING, 'Does your character enjoy reading %s?', 'Seu personagem gosta de ler %s?', [
                ['fiction books', 'livros de ficção'],
                ['non-fiction books', 'livros de não ficção'],
                ['biographies', 'biografias'],
                ['history books', 'livros de história'],
                ['science books', 'livros de ciencia'],
                ['manga or comics', 'manga ou quadrinhos'],
                ['poetry', 'poesia'],
                ['philosophy texts', 'textos de filosofia'],
            ]],
            [AttributeSubgroup::GAMING, 'Does your character play %s?', 'Seu personagem joga %s?', [
                ['video games daily', 'videogame diariamente'],
                ['strategy games', 'jogos de estrategia'],
                ['sports games', 'jogos de esporte'],
                ['role-playing games', 'rpg'],
                ['competitive online games', 'jogos online competitivos'],
                ['retro games', 'jogos retro'],
                ['mobile games', 'jogos mobile'],
                ['co-op games with friends', 'jogos cooperativos com amigos'],
            ]],
            [AttributeSubgroup::COOKING, 'Does your character like %s?', 'Seu personagem gosta de %s?', [
                ['cooking at home', 'cozinhar em casa'],
                ['trying new recipes', 'testar novas receitas'],
                ['baking desserts', 'fazer sobremesas'],
                ['grilling barbecue', 'fazer churrasco'],
                ['healthy cooking', 'cozinha saudavel'],
                ['traditional dishes', 'pratos tradicionais'],
                ['international cuisine', 'culinaria internacional'],
                ['cooking competitively', 'cozinhar de forma competitiva'],
            ]],
            [AttributeSubgroup::GARDENING, 'Does your character enjoy %s?', 'Seu personagem gosta de %s?', [
                ['growing flowers', 'cultivar flores'],
                ['growing vegetables', 'cultivar vegetais'],
                ['taking care of indoor plants', 'cuidar de plantas internas'],
                ['landscape gardening', 'jardinagem paisagistica'],
                ['bonsai', 'bonsai'],
                ['organic composting', 'compostagem orgânica'],
                ['watering plants daily', 'regar plantas diariamente'],
                ['urban gardening', 'jardinagem urbana'],
            ]],
            [AttributeSubgroup::FITNESS, 'Does your character practice %s?', 'Seu personagem pratica %s?', [
                ['gym training', 'musculação'],
                ['running', 'corrida'],
                ['yoga', 'yoga'],
                ['crossfit', 'crossfit'],
                ['calisthenics', 'calistenia'],
                ['pilates', 'pilates'],
                ['martial arts training', 'treino de artes marciais'],
                ['daily physical routines', 'rotinas físicas diarias'],
            ]],
            [AttributeSubgroup::OUTDOOR_ACTIVITIES, 'Does your character enjoy %s?', 'Seu personagem gosta de %s?', [
                ['hiking', 'trilha'],
                ['camping', 'acampamento'],
                ['fishing', 'pesca'],
                ['cycling outdoors', 'pedalar ao ar livre'],
                ['climbing', 'escalada'],
                ['kayaking', 'caiaque'],
                ['wildlife exploration', 'exploração da natureza'],
                ['adventure expeditions', 'expedições de aventura'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function accomplishments(): void
    {
        $groups = [
            [AttributeSubgroup::AWARDS, 'Has your character won %s?', 'Seu personagem ganhou %s?', [
                ['major international awards', 'prêmios internacionais importantes'],
                ['national awards', 'prêmios nacionais'],
                ['industry awards', 'prêmios da industria'],
                ['lifetime achievement awards', 'prêmios de carreira'],
                ['multiple awards in one season', 'múltiplos prêmios em uma temporada'],
                ['audience choice awards', 'prêmios de voto popular'],
                ['critics awards', 'prêmios da critica'],
                ['a prestigious top-tier award', 'um prêmio de alto prestígio'],
            ]],
            [AttributeSubgroup::RECORDS, 'Does your character hold %s?', 'Seu personagem possui %s?', [
                ['a world record', 'recorde mundial'],
                ['a national record', 'recorde nacional'],
                ['a long-standing record', 'recorde duradouro'],
                ['multiple records', 'múltiplos recordes'],
                ['a speed record', 'recorde de velocidade'],
                ['a performance record', 'recorde de desempenho'],
                ['an unbeaten record', 'recorde invicto'],
                ['a record recognized officially', 'recorde reconhecido oficialmente'],
            ]],
            [AttributeSubgroup::ACCOMPLISHMENT_TITLES, 'Is your character known by %s?', 'Seu personagem é conhecido por %s?', [
                ['champion title', 'título de campeão'],
                ['world champion title', 'título de campeão mundial'],
                ['national champion title', 'título de campeão nacional'],
                ['honorary title', 'título honorário'],
                ['legend title', 'título de lenda'],
                ['hero title', 'título de herói'],
                ['master title', 'título de mestre'],
                ['record-holder title', 'título de recordista'],
            ]],
            [AttributeSubgroup::CERTIFICATIONS, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['professional certifications', 'certificações profissionais'],
                ['academic certifications', 'certificações acadêmicas'],
                ['technical certifications', 'certificações técnicas'],
                ['international certifications', 'certificações internacionais'],
                ['specialized training certificates', 'certificados de treinamento especializado'],
                ['medical certifications', 'certificações medicas'],
                ['legal certifications', 'certificações jurídicas'],
                ['elite qualification badges', 'selos de qualificação de elite'],
            ]],
            [AttributeSubgroup::RECOGNITION, 'Has your character received %s?', 'Seu personagem recebeu %s?', [
                ['public recognition', 'reconhecimento publico'],
                ['media recognition', 'reconhecimento da mídia'],
                ['peer recognition', 'reconhecimento dos pares'],
                ['institutional recognition', 'reconhecimento institucional'],
                ['international recognition', 'reconhecimento internacional'],
                ['community recognition', 'reconhecimento da comunidade'],
                ['honorary mentions', 'mencoes honrosas'],
                ['a historic level of recognition', 'um nivel historico de reconhecimento'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function history(): void
    {
        $groups = [
            [AttributeSubgroup::HISTORICAL_PERIOD, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['ancient history', 'história antiga'],
                ['medieval times', 'Idade Média'],
                ['renaissance period', 'renascimento'],
                ['industrial era', 'era industrial'],
                ['world war period', 'periodo das guerras mundiais'],
                ['cold war era', 'guerra fria'],
                ['modern history', 'história moderna'],
                ['contemporary history', 'história contemporânea'],
            ]],
            [AttributeSubgroup::HISTORICAL_EVENT, 'Was your character involved in %s?', 'Seu personagem esteve envolvido em %s?', [
                ['a revolution', 'uma revolução'],
                ['a major war', 'uma grande guerra'],
                ['a political transition', 'uma transição política'],
                ['a scientific breakthrough', 'um grande avanco cientifico'],
                ['a social movement', 'um movimento social'],
                ['a cultural milestone', 'um marco cultural'],
                ['an independence process', 'um processo de independencia'],
                ['a globally influential event', 'um evento de impacto global'],
            ]],
            [AttributeSubgroup::HISTORICAL_ROLE, 'Did your character act as %s?', 'Seu personagem atuou como %s?', [
                ['a ruler', 'governante'],
                ['a military leader', 'lider militar'],
                ['a reformer', 'reformador'],
                ['a revolutionary', 'revolucionário'],
                ['a diplomat', 'diplomata'],
                ['an inventor', 'inventor'],
                ['an explorer', 'explorador'],
                ['a key witness of history', 'testemunha chave da história'],
            ]],
            [AttributeSubgroup::HISTORICAL_IMPACT, 'Did your character have %s impact?', 'Seu personagem teve impacto %s?', [
                ['global', 'global'],
                ['national', 'nacional'],
                ['regional', 'regional'],
                ['cultural', 'cultural'],
                ['scientific', 'científico'],
                ['political', 'político'],
                ['economic', 'econômico'],
                ['long-term historical', 'histórico de longo prazo'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function geography(): void
    {
        $groups = [
            [AttributeSubgroup::CONTINENT, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['South America', 'América do Sul'],
                ['North America', 'América do Norte'],
                ['Europe', 'Europa'],
                ['Ásia', 'Ásia'],
                ['África', 'África'],
                ['Oceania', 'Oceania'],
                ['a fictional continent', 'um continente fictício'],
                ['multiple continents', 'múltiplos continentes'],
            ]],
            [AttributeSubgroup::COUNTRY, 'Is your character linked to %s?', 'Seu personagem está ligado a %s?', [
                ['Brazil', 'Brasil'],
                ['United States', 'Estados Unidos'],
                ['Japan', 'Japão'],
                ['United Kingdom', 'Reino Unido'],
                ['France', 'França'],
                ['Germany', 'Alemanha'],
                ['Italy', 'Itália'],
                ['a fictional country', 'um pais fictício'],
            ]],
            [AttributeSubgroup::STATE_OR_PROVINCE, 'Is your character linked to %s?', 'Seu personagem está ligado a %s?', [
                ['a specific state', 'um estado específico'],
                ['a specific province', 'uma província específica'],
                ['a capital district', 'um distrito capital'],
                ['a coastal state', 'um estado costeiro'],
                ['an inland state', 'um estado do interior'],
                ['a northern region state', 'um estado da regiao norte'],
                ['a southern region state', 'um estado da regiao sul'],
                ['a fictional province', 'uma província fictícia'],
            ]],
            [AttributeSubgroup::CITY, 'Is your character strongly linked to %s?', 'Seu personagem é fortemente ligado a %s?', [
                ['a major capital city', 'uma grande capital'],
                ['a small town', 'uma cidade pequena'],
                ['a coastal city', 'uma cidade litorânea'],
                ['a mountain city', 'uma cidade de montanha'],
                ['a metropolitan area', 'uma area metropolitana'],
                ['a historically important city', 'uma cidade historicamente importante'],
                ['a tech-focused city', 'uma cidade focada em tecnologia'],
                ['a fictional city', 'uma cidade fictícia'],
            ]],
            [AttributeSubgroup::REGION, 'Is your character tied to %s?', 'Seu personagem está ligado a %s?', [
                ['a cultural region', 'uma regiao cultural'],
                ['a rural region', 'uma regiao rural'],
                ['an urban region', 'uma regiao urbana'],
                ['a conflict region', 'uma regiao de conflito'],
                ['a tourist region', 'uma regiao turística'],
                ['a border region', 'uma regiao de fronteira'],
                ['a strategic region', 'uma regiao estratégica'],
                ['a legendary region', 'uma regiao lendária'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function technology(): void
    {
        $groups = [
            [AttributeSubgroup::COMPUTING, 'Is your character involved in %s?', 'Seu personagem está envolvido com %s?', [
                ['computer science', 'ciencia da computação'],
                ['hardware development', 'desenvolvimento de hardware'],
                ['software engineering', 'engenharia de software'],
                ['computer security', 'segurança da computação'],
                ['high-performance computing', 'computação de alto desempenho'],
                ['system architecture', 'arquitetura de sistemas'],
                ['data processing', 'processamento de dados'],
                ['computer innovation', 'inovação computacional'],
            ]],
            [AttributeSubgroup::PROGRAMMING, 'Does your character work with %s?', 'Seu personagem trabalha com %s?', [
                ['backend development', 'desenvolvimento backend'],
                ['frontend development', 'desenvolvimento frontend'],
                ['mobile development', 'desenvolvimento mobile'],
                ['game programming', 'programação de jogos'],
                ['embedded programming', 'programação embarcada'],
                ['algorithms', 'algoritmos'],
                ['open source code', 'codigo open source'],
                ['automation scripts', 'scripts de automação'],
            ]],
            [AttributeSubgroup::ARTIFICIAL_INTELLIGENCE, 'Is your character connected to %s?', 'Seu personagem está ligado a %s?', [
                ['machine learning', 'aprendizado de máquina'],
                ['neural networks', 'redes neurais'],
                ['robotics ai', 'ia para robotica'],
                ['natural language processing', 'processamento de linguagem natural'],
                ['computer vision', 'visao computacional'],
                ['ai ethics', 'etica em ia'],
                ['autonomous systems', 'sistemas autônomos'],
                ['advanced ai research', 'pesquisa avancada em ia'],
            ]],
            [AttributeSubgroup::ELECTRONICS, 'Does your character work with %s?', 'Seu personagem trabalha com %s?', [
                ['circuits', 'circuitos'],
                ['microcontrollers', 'microcontroladores'],
                ['sensor systems', 'sistemas de sensores'],
                ['consumer electronics', 'eletrônicos de consumo'],
                ['industrial electronics', 'eletrônica industrial'],
                ['wearable devices', 'dispositivos vestíveis'],
                ['repairing electronics', 'conserto de eletrônicos'],
                ['electronic prototyping', 'prototipagem eletrônica'],
            ]],
            [AttributeSubgroup::INTERNET_TECHNOLOGY, 'Is your character related to %s?', 'Seu personagem está ligado a %s?', [
                ['web infrastructure', 'infraestrutura web'],
                ['cloud computing', 'computação em nuvem'],
                ['social platforms', 'plataformas sociais'],
                ['cybersecurity', 'cibersegurança'],
                ['internet startups', 'startups de internet'],
                ['online services', 'servicos online'],
                ['network technologies', 'tecnologias de rede'],
                ['internet-scale systems', 'sistemas em escala de internet'],
            ]],
            [AttributeSubgroup::SPACE_TECHNOLOGY, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['space missions', 'missões espaciais'],
                ['rocketry', 'foguetes'],
                ['satellite technology', 'tecnologia de satelites'],
                ['space exploration engineering', 'engenharia de exploração espacial'],
                ['astronaut operations', 'operações de astronáutica'],
                ['deep space research', 'pesquisa de espaco profundo'],
                ['planetary technology', 'tecnologia planetaria'],
                ['advanced aerospace systems', 'sistemas aeroespaciais avancados'],
            ]],
            [AttributeSubgroup::VEHICLES, 'Does your character specialize in %s?', 'Seu personagem se especializa em %s?', [
                ['cars', 'carros'],
                ['motorcycles', 'motos'],
                ['aircraft', 'aeronaves'],
                ['ships', 'navios'],
                ['racing vehicles', 'veiculos de corrida'],
                ['military vehicles', 'veiculos militares'],
                ['autonomous vehicles', 'veiculos autônomos'],
                ['experimental transport', 'transporte experimental'],
            ]],
            [AttributeSubgroup::WEAPONS, 'Is your character linked to %s?', 'Seu personagem está ligado a %s?', [
                ['sword combat weapons', 'armas de combate com espada'],
                ['firearms', 'armas de fogo'],
                ['energy weapons', 'armas de energia'],
                ['defensive weapons systems', 'sistemas de armas defensivas'],
                ['military-grade weapons', 'armas de nivel militar'],
                ['historical weapons', 'armas historicas'],
                ['weapon engineering', 'engenharia de armamentos'],
                ['signature weapon usage', 'uso de arma assinatura'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function fiction(): void
    {
        $groups = [
            [AttributeSubgroup::ALIGNMENT, 'Is your character %s?', 'Seu personagem %s?', [
                ['heroic', 'é heroico', SecondaryAttribute::ALIGNMENT_HEROIC],
                ['villainous', 'é vilanesco', SecondaryAttribute::ALIGNMENT_VILLAINOUS],
                ['anti-heroic', 'é anti-heroi'],
                ['morally gray', 'é moralmente cinza'],
                ['chaotic', 'é caótico'],
                ['lawful', 'é ordeiro'],
                ['neutral', 'é neutro'],
                ['unpredictable in alignment', 'tem alinhamento imprevisível'],
            ]],
            [AttributeSubgroup::ROLE, 'Is your character primarily a %s?', 'Seu personagem é principalmente %s?', [
                ['protagonist', 'protagonista'],
                ['antagonist', 'antagonista'],
                ['supporting character', 'personagem de apoio'],
                ['mentor', 'mentor'],
                ['comic relief', 'alivio comico'],
                ['rival', 'rival'],
                ['leader figure', 'figura de lideranca'],
                ['mysterious wildcard', 'coringa misterioso'],
            ]],
            [AttributeSubgroup::OCCUPATION, 'In fiction, is your character a %s?', 'Na ficção, seu personagem é %s?', [
                ['warrior', 'guerreiro'],
                ['detective', 'detetive'],
                ['wizard', 'mago'],
                ['thief', 'ladrão'],
                ['scientist', 'cientista'],
                ['soldier', 'soldado'],
                ['student', 'estudante'],
                ['royalty member', 'membro da realeza'],
            ]],
            [AttributeSubgroup::ORIGIN, 'Does your character come from %s?', 'Seu personagem vem de %s?', [
                ['a hidden village', 'uma vila escondida'],
                ['another dimension', 'outra dimensão'],
                ['a royal bloodline', 'uma linhagem real'],
                ['a tragic past', 'um passado tragico'],
                ['an experimental lab', 'um laboratório experimental'],
                ['a distant planet', 'um planeta distante'],
                ['an ancient prophecy', 'uma profecia antiga'],
                ['a mysterious origin', 'origem misteriosa'],
            ]],
            [AttributeSubgroup::UNIVERSE, 'Is your character from %s?', 'Seu personagem é de %s?', [
                ['a superhero universe', 'um universo de super-herois'],
                ['an anime universe', 'um universo de anime'],
                ['a fantasy universe', 'um universo de fantasia'],
                ['a sci-fi universe', 'um universo de ficção científica'],
                ['a game universe', 'um universo de game'],
                ['a comic universe', 'um universo de quadrinhos'],
                ['a multiverse setting', 'um contexto de multiverso'],
                ['a crossover universe', 'um universo de crossover'],
            ]],
            [AttributeSubgroup::ORGANIZATION, 'Is your character part of %s?', 'Seu personagem faz parte de %s?', [
                ['a hero team', 'um time de herois'],
                ['a villain group', 'um grupo de viloes'],
                ['a military unit', 'uma unidade militar'],
                ['a secret society', 'uma sociedade secreta'],
                ['a guild', 'uma guilda'],
                ['a royal order', 'uma ordem real'],
                ['a rebel faction', 'uma facção rebelde'],
                ['an elite task force', 'uma força tarefa de elite'],
            ]],
            [AttributeSubgroup::EQUIPMENT, 'Does your character use %s?', 'Seu personagem usa %s?', [
                ['a signature weapon', 'arma assinatura'],
                ['advanced armor', 'armadura avancada'],
                ['magic artifacts', 'artefatos mágicos'],
                ['high-tech gadgets', 'gadgets de alta tecnologia'],
                ['a shield', 'escudo'],
                ['special vehicles', 'veiculos especiais'],
                ['combat tools', 'ferramentas de combate'],
                ['equipment central to identity', 'equipamento central para identidade'],
            ]],
            [AttributeSubgroup::TRANSFORMATION, 'Can your character %s?', 'Seu personagem consegue %s?', [
                ['transform into another form', 'se transformar em outra forma'],
                ['power up during battle', 'ficar mais forte durante batalha'],
                ['enter a berserk state', 'entrar em estado berserk'],
                ['unlock hidden forms', 'desbloquear formas ocultas'],
                ['evolve over time', 'evoluir com o tempo'],
                ['switch between forms', 'alternar entre formas'],
                ['fuse with others', 'fundir com outros'],
                ['temporarily mutate', 'mutar temporariamente'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function powers(): void
    {
        $groups = [
            [AttributeSubgroup::PHYSICAL_POWERS, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['super strength', 'super forca'],
                ['enhanced durability', 'durabilidade aprimorada'],
                ['enhanced reflexes', 'reflexos aprimorados'],
                ['enhanced stamina', 'resistência aprimorada'],
                ['enhanced senses', 'sentidos aprimorados'],
                ['enhanced regeneration', 'regeneração aprimorada'],
                ['combat mastery', 'maestria em combate'],
                ['peak physical condition', 'condição física maxima'],
            ]],
            [AttributeSubgroup::ELEMENTAL_POWERS, 'Can your character control %s?', 'Seu personagem controla %s?', [
                ['fire', 'fogo'],
                ['water', 'água'],
                ['earth', 'terra'],
                ['air', 'ar'],
                ['lightning', 'raios'],
                ['ice', 'gelo'],
                ['metal', 'metal'],
                ['multiple elements', 'múltiplos elementos'],
            ]],
            [AttributeSubgroup::MENTAL_POWERS, 'Does your character possess %s?', 'Seu personagem possui %s?', [
                ['telepathy', 'telepatia'],
                ['mind control', 'controle mental'],
                ['telekinesis', 'telecinese'],
                ['enhanced memory', 'memoria aprimorada'],
                ['future prediction', 'previsao do futuro'],
                ['emotion manipulation', 'manipulação de emoção'],
                ['illusion casting', 'criação de ilusões'],
                ['mental shielding', 'barreira mental'],
            ]],
            [AttributeSubgroup::MAGICAL_POWERS, 'Can your character use %s?', 'Seu personagem usa %s?', [
                ['spell casting', 'lancamento de feiticos'],
                ['summoning', 'invocação'],
                ['healing magic', 'magia de cura'],
                ['curse magic', 'magia de maldicão'],
                ['protective magic', 'magia de proteção'],
                ['dark magic', 'magia sombria'],
                ['holy magic', 'magia sagrada'],
                ['ritual magic', 'magia ritual'],
            ]],
            [AttributeSubgroup::SPACE_TIME_POWERS, 'Can your character manipulate %s?', 'Seu personagem manipula %s?', [
                ['time', 'tempo'],
                ['space', 'espaco'],
                ['gravity', 'gravidade'],
                ['portals', 'portais'],
                ['timelines', 'linhas do tempo'],
                ['dimensions', 'dimensões'],
                ['causality', 'causalidade'],
                ['reality distortion', 'distorção da realidade'],
            ]],
            [AttributeSubgroup::MOVEMENT_POWERS, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['super speed', 'super velocidade'],
                ['flight', 'voo'],
                ['teleportation', 'teletransporte'],
                ['wall climbing', 'escalar paredes'],
                ['water walking', 'andar sobre água'],
                ['phase movement', 'movimento de atravessar objetos'],
                ['acrobatic mobility', 'mobilidade acrobatica'],
                ['instant dash', 'arranque instantaneo'],
            ]],
            [AttributeSubgroup::DEFENSIVE_POWERS, 'Does your character use %s?', 'Seu personagem usa %s?', [
                ['energy shields', 'escudos de energia'],
                ['damage absorption', 'absorcao de dano'],
                ['invulnerability phases', 'fases de invulnerabilidade'],
                ['counter barriers', 'barreiras de contra-ataque'],
                ['healing factor', 'fator de cura'],
                ['elemental resistance', 'resistência elemental'],
                ['mental resistance', 'resistência mental'],
                ['magic resistance', 'resistência mágica'],
            ]],
            [AttributeSubgroup::OFFENSIVE_POWERS, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['energy blasts', 'rajadas de energia'],
                ['shockwaves', 'ondas de choque'],
                ['explosive attacks', 'ataques explosivos'],
                ['piercing attacks', 'ataques perfurantes'],
                ['area attacks', 'ataques em area'],
                ['precision strikes', 'golpes de precisao'],
                ['long-range attacks', 'ataques de longa distancia'],
                ['devastating finishing moves', 'golpes finais devastadores'],
            ]],
            [AttributeSubgroup::SPECIAL_ABILITIES, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['shape-shifting', 'metamorfose'],
                ['invisibility', 'invisibilidade'],
                ['copying abilities', 'copiar habilidades'],
                ['energy draining', 'drenagem de energia'],
                ['beast communication', 'comunicação com animais'],
                ['luck manipulation', 'manipulação de sorte'],
                ['probability control', 'controle de probabilidade'],
                ['unique signature power', 'poder assinatura único'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function miscellaneous(): void
    {
        $groups = [
            [AttributeSubgroup::NICKNAMES, 'Is your character known by %s?', 'Seu personagem é conhecido por %s?', [
                ['a famous nickname', 'um apelido famoso'],
                ['more than one nickname', 'mais de um apelido'],
                ['a childhood nickname', 'apelido de infância'],
                ['a title-like nickname', 'apelido em forma de titulo'],
                ['a nickname from fans', 'apelido dado por fans'],
                ['a mocking nickname', 'apelido provocativo'],
                ['a heroic codename', 'codinome heroico'],
                ['a nickname used more than real name', 'apelido usado mais que nome real'],
            ]],
            [AttributeSubgroup::LEGAL, 'Has your character faced %s?', 'Seu personagem enfrentou %s?', [
                ['legal issues', 'problemas legais'],
                ['court cases', 'processos judiciais'],
                ['criminal accusations', 'acusações criminais'],
                ['civil disputes', 'disputas civis'],
                ['public legal controversies', 'controversias legais públicas'],
                ['investigations', 'investigações'],
                ['official acquittals', 'absolvições oficiais'],
                ['major legal consequences', 'grandes consequências legais'],
            ]],
            [AttributeSubgroup::PHILANTHROPY, 'Is your character involved in %s?', 'Seu personagem está envolvido em %s?', [
                ['charity donations', 'doações beneficentes'],
                ['social projects', 'projetos sociais'],
                ['education support', 'apoio a educação'],
                ['health campaigns', 'campanhas de saude'],
                ['community fundraising', 'arrecadação comunitaria'],
                ['disaster relief actions', 'acoes de ajuda em desastres'],
                ['long-term foundations', 'fundações de longo prazo'],
                ['philanthropy as public image', 'filantropia como imagem pública'],
            ]],
            [AttributeSubgroup::CONTROVERSIES, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['public scandals', 'escândalos publicos'],
                ['media backlash', 'reação negativa da mídia'],
                ['polarizing opinions', 'opiniões polarizadas'],
                ['career controversies', 'controversias na carreira'],
                ['political controversy', 'controversia política'],
                ['online controversy', 'controversia online'],
                ['ethical debates', 'debates éticos'],
                ['frequent public criticism', 'críticas públicas frequentes'],
            ]],
            [AttributeSubgroup::CATCHPHRASES, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['an iconic catchphrase', 'frase de efeito icônica'],
                ['a repeated slogan', 'slogan repetido'],
                ['a battle quote', 'frase de batalha'],
                ['a humorous recurring line', 'frase recorrente humorística'],
                ['a motivational phrase', 'frase motivacional'],
                ['a phrase known by fans', 'frase conhecida pelos fans'],
                ['a phrase used in media clips', 'frase usada em clipes'],
                ['speech style with memorable lines', 'estilo de fala com frases marcantes'],
            ]],
            [AttributeSubgroup::RIVALRIES, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['a famous rival', 'um rival famoso'],
                ['multiple rivals', 'múltiplos rivais'],
                ['a lifelong rivalry', 'rivalidade de toda a vida'],
                ['a rivalry in the same team', 'rivalidade no mesmo time'],
                ['a rivalry with ideological conflict', 'rivalidade por conflito ideológico'],
                ['a friendly rivalry', 'rivalidade amigável'],
                ['a media-driven rivalry', 'rivalidade alimentada pela mídia'],
                ['a rivalry central to their story', 'rivalidade central na história'],
            ]],
            [AttributeSubgroup::SIGNATURE_TRAITS, 'Is your character known for %s?', 'Seu personagem é conhecido por %s?', [
                ['a unique laugh', 'uma risada única'],
                ['a specific pose', 'uma pose específica'],
                ['a symbolic accessory', 'um acessorio simbolico'],
                ['a recognizable voice', 'uma voz reconhecível'],
                ['a distinct fighting style', 'um estilo de luta distinto'],
                ['an unmistakable attitude', 'uma atitude inconfundível'],
                ['a dramatic entrance', 'uma entrada dramática'],
                ['a trait fans instantly recognize', 'um traco que os fans reconhecem na hora'],
            ]],
        ];

        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }
}

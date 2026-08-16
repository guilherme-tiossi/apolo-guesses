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
        $this->accomplishments();
        $this->history();
        $this->geography();
        $this->fiction();
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

    private function seedGroups(array $groups): void
    {
        $attributes = [];
        foreach ($groups as [$subgroup, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($subgroup, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function appearance(): void
    {
        $this->seedGroups([
            [AttributeSubgroup::HEIGHT, 'Is your character %s?', 'Seu personagem é %s?', [
                ['very tall', 'muito alto'],
                ['short', 'baixo'],
            ]],
            [AttributeSubgroup::WEIGHT, 'Does your character look %s?', 'Seu personagem parece %s?', [
                ['slim', 'magro'],
                ['lean', 'em forma'],
                ['muscular', 'musculoso'],
                ['fat', 'gordo'],
            ]],
            [AttributeSubgroup::SKIN_COLOR, 'Does your character have %s skin?', 'Seu personagem tem pele %s?', [
                ['fair', 'clara', InitialAttribute::SKIN_FAIR],
                ['dark', 'escura', InitialAttribute::SKIN_DARK],
            ]],
            [AttributeSubgroup::HAIR_COLOR, 'Does your character have %s hair?', 'Seu personagem tem cabelo %s?', [
                ['dark', 'escuro'],
                ['blond', 'loiro'],
                ['red', 'ruivo'],
                ['white', 'branco'],
                ['gray', 'grisalho'],
            ]],
            [AttributeSubgroup::HAIR_LENGTH, 'Does your character have %s hair?', 'Seu personagem tem %s?', [
                ['short', 'cabelo curto'],
                ['long', 'cabelo longo'],
                ['no', 'a cabeça careca'],
            ]],
            [AttributeSubgroup::HAIR_TEXTURE, 'Is your character hair texture %s?', 'A textura do cabelo do seu personagem é %s?', [
                ['straight', 'lisa'],
                ['coily', 'crespa'],
            ]],
            [AttributeSubgroup::FACIAL_HAIR, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['beard', 'barba'],
                ['a mustache', 'bigode'],
            ]],
            [AttributeSubgroup::EYE_COLOR, 'Does your character have %s eyes?', 'Seu personagem tem olhos %s?', [
                ['dark', 'escuros'],
                ['light', 'claros'],
            ]],
            [AttributeSubgroup::SPECIES, 'Is your character %s?', 'Seu personagem é %s?', [
                ['human', 'humano'],
                ['mutant', 'mutante'],
                ['android', 'androide'],
                ['vampire', 'vampiro'],
            ]],
            [AttributeSubgroup::STYLE, 'Does your character usually wear a %s style?', 'Seu personagem geralmente usa estilo %s?', [
                ['casual', 'casual'],
                ['formal', 'formal'],
                ['sporty', 'esportivo'],
                ['elegant', 'elegante'],
            ]],
            [AttributeSubgroup::DISTINCTIVE_FEATURES, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['a visible tattoo', 'tatuagem visível'],
                ['a unique scar', 'cicatriz única'],
                ['a mask', 'máscara'],
                ['a cape', 'capa'],
            ]],
        ]);
    }

    private function identity(): void
    {
        $this->seedGroups([
            [AttributeSubgroup::AGE, 'Is your character %s?', 'Seu personagem %s?', [
                ['a child', 'é criança', InitialAttribute::AGE_CHILD],
                ['a teenager', 'é adolescente', InitialAttribute::AGE_TEENAGER],
                ['an adult', 'é adulto', InitialAttribute::AGE_ADULT],
                ['over forty', 'está acima dos quarenta', InitialAttribute::AGE_OVER_FORTY],
                ['elderly', 'é idoso', InitialAttribute::AGE_ELDERLY],
            ]],
            [AttributeSubgroup::GENDER, 'Is your character %s?', 'Seu personagem %s?', [
                ['male', 'é homem', InitialAttribute::GENDER_MALE],
                ['female', 'é mulher', InitialAttribute::GENDER_FEMALE],
            ]],
            [AttributeSubgroup::NATIONALITY, 'Is your character %s?', 'Seu personagem %s?', [
                ['Brazilian', 'é brasileiro', InitialAttribute::NATIONALITY_BRAZILIAN],
                ['American', 'é americano'],
                ['Japanese', 'é japonês'],
                ['British', 'é britânico'],
                ['French', 'é francês'],
                ['German', 'é alemão'],
                ['fictional', 'é fictício', InitialAttribute::NATIONALITY_FICTICIONAL],
            ]],
            [AttributeSubgroup::ETHNICITY, 'Is your character described as %s?', 'Seu personagem é descrito como %s?', [
                ['black', 'negro'],
                ['white', 'branco'],
                ['asian', 'asiático'],
                ['latino', 'latino'],
                ['indigenous', 'indígena'],
            ]],
            [AttributeSubgroup::LANGUAGES, 'Does your character %s?', 'Seu personagem %s?', [
                ['speak Portuguese', 'fala português'],
                ['speak English', 'fala inglês'],
                ['speak Spanish', 'fala espanhol'],
                ['speak with a strong accent', 'fala com sotaque forte'],
            ]],
            [AttributeSubgroup::IDENTITY_TITLES, 'Is your character known as %s?', 'Seu personagem é conhecido como %s?', [
                ['a king or queen', 'rei ou rainha'],
                ['a president', 'presidente'],
                ['a professor', 'professor'],
                ['a doctor', 'doutor'],
            ]],
            [AttributeSubgroup::LIVING_STATUS, 'Is your character %s?', 'Seu personagem %s?', [
                ['alive', 'está vivo', InitialAttribute::LIVING_ALIVE],
                ['deceased', 'está morto', InitialAttribute::LIVING_DECEASED],
            ]],
            [AttributeSubgroup::LIVING_STATUS, 'Did your character die in %s?', 'Seu personagem morreu em %s?', [
                ['tragic circumstances', 'circunstâncias trágicas'],
            ]],
            [AttributeSubgroup::RELIGION, 'Is religion one of the defining traits of your character?', 'A religião é um dos aspectos principais de seu personagem?', [
                ['', '', SecondaryAttribute::RELIGION_IMPORTANT],
            ]],
            [AttributeSubgroup::RELIGION, 'Does your character identify as %s?', 'Seu personagem se identifica como %s?', [
                ['Christian', 'cristao', SecondaryAttribute::RELIGION_CHRISTIAN],
                ['Muslim', 'muçulmano', SecondaryAttribute::RELIGION_MUSLIM],
                ['Jewish', 'judeu', SecondaryAttribute::RELIGION_JEWISH],
                ['Buddhist', 'budista', SecondaryAttribute::RELIGION_BUDDHIST],
                ['atheist', 'ateu', SecondaryAttribute::RELIGION_ATHEIST],
                ['agnostic', 'agnóstico', SecondaryAttribute::RELIGION_AGNOSTIC],
            ]],
            [AttributeSubgroup::FAMILY, 'Does your character %s?', 'Seu personagem %s?', [
                ['have children', 'tem filhos'],
                ['come from a famous family', 'vem de familia famosa'],
            ]],
            [AttributeSubgroup::POLITICAL_PROFILE, 'Is your character %s?', 'Seu personagem %s?', [
                ['politically active', 'é politicamente ativo'],
                ['a conservative figure', 'é figura conservadora', SecondaryAttribute::POLITICAL_CONSERVATIVE],
                ['a progressive figure', 'é figura progressista', SecondaryAttribute::POLITICAL_PROGRESSIVE],
                ['an activist', 'é ativista'],
                ['a revolutionary', 'é revolucionário'],
            ]],
            [AttributeSubgroup::EDUCATION, 'Does your character %s?', 'Seu personagem %s?', [
                ['have a university degree', 'tem diploma universitário'],
                ['be self-taught', 'é autodidata'],
                ['have formal military training', 'tem treinamento militar formal'],
            ]],
        ]);
    }

    private function personality(): void
    {
        $this->seedGroups([
            [AttributeSubgroup::TEMPERAMENT, 'Is your character %s?', 'Seu personagem %s?', [
                ['calm', 'é calmo'],
                ['aggressive', 'é agressivo'],
                ['impulsive', 'é impulsivo'],
                ['warm and friendly', 'é caloroso e amigável'],
            ]],
            [AttributeSubgroup::INTELLIGENCE, 'Is your character %s?', 'Seu personagem %s?', [
                ['analytical', 'é analítico'],
                ['street-smart', 'é esperto na pratica'],
                ['book-smart', 'é muito estudioso'],
                ['strategic', 'é estrategista'],
            ]],
            [AttributeSubgroup::HUMOR, 'Does your character %s?', 'Seu personagem %s?', [
                ['make jokes often', 'faz piadas com frequência'],
                ['laugh loudly', 'ri alto'],
            ]],
            [AttributeSubgroup::LEADERSHIP, 'Does your character %s?', 'Seu personagem %s?', [
                ['lead a team', 'lidera um time'],
                ['inspire others', 'inspira os outros'],
                ['take command in crisis', 'assume comando em crises'],
                ['have followers', 'tem seguidores'],
            ]],
            [AttributeSubgroup::MORALITY, 'Is your character %s?', 'Seu personagem %s?', [
                ['morally upright', 'é moralmente correto'],
                ['morally gray', 'é moralmente cinza'],
                ['justice-driven', 'é movido por justiça'],
            ]],
            [AttributeSubgroup::LIFESTYLE, 'Does your character live a %s lifestyle?', 'Seu personagem vive um estilo de vida %s?', [
                ['luxurious', 'luxuoso'],
                ['simple', 'simples'],
                ['urban', 'urbano'],
            ]],
        ]);
    }

    private function career(): void
    {
        $this->seedGroups([
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
                ['public administration', 'administração pública'],
            ]],
            [AttributeSubgroup::ARTS, 'Is your character active in %s?', 'Seu personagem atua em %s?', [
                ['music', 'música'],
                ['cinema', 'cinema'],
                ['literature', 'literatura'],
                ['theater', 'teatro'],
            ]],
            [AttributeSubgroup::BUSINESS, 'Does your character %s?', 'Seu personagem %s?', [
                ['own a company', 'é dono de empresa'],
                ['manage large teams', 'gerencia equipes grandes'],
                ['focus on sales', 'foca em vendas'],
            ]],
            [AttributeSubgroup::MEDIA, 'Does your character work mainly in %s?', 'Seu personagem trabalha principalmente com %s?', [
                ['television', 'televisão'],
                ['journalism', 'jornalismo'],
                ['online digital content', 'conteudo digital online', InitialAttribute::MEDIA_DIGITAL_CONTENT],
                ['social platforms', 'plataformas sociais'],
            ]],
            [AttributeSubgroup::PUBLIC_SERVICE, 'Does your character serve/served in %s?', 'Seu personagem atua/atuou em %s?', [
                ['government office', 'cargo publico'],
                ['diplomacy', 'diplomacia'],
            ]],
        ]);
    }

    private function sports(): void
    {
        $this->seedGroups([
            [AttributeSubgroup::FOOTBALL, 'Does your character %s?', 'Seu personagem %s?', [
                ['play football professionally', 'joga futebol profissionalmente'],
                ['score many goals', 'marca muitos gols'],
                ['play in international tournaments', 'joga torneios internacionais'],
                ['be known for dribbling', 'é conhecido por dribles'],
            ]],
            [AttributeSubgroup::BASKETBALL, 'Does your character %s?', 'Seu personagem %s?', [
                ['play basketball professionally', 'joga basquete profissionalmente'],
                ['win basketball championships', 'vence campeonatos de basquete'],
            ]],
            [AttributeSubgroup::OTHER_SPORTS, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['tennis', 'tênis'],
                ['motorsports', 'automobilismo'],
                ['olympic events', 'eventos olimpicos'],
                ['surfing', 'surfe'],
            ]],
            [AttributeSubgroup::COMBAT_SPORTS, 'Does your character compete in %s?', 'Seu personagem compete em %s?', [
                ['boxing', 'boxe'],
                ['mma', 'mma'],
                ['high-level combat tournaments', 'torneios de combate de alto nivel'],
            ]],
            [AttributeSubgroup::ESPORTS, 'Does your character %s?', 'Seu personagem %s?', [
                ['compete in esports', 'compete em esports'],
                ['be famous in gaming communities', 'é famoso em comunidades de games'],
            ]],
        ]);
    }

    private function entertainment(): void
    {
        $this->seedGroups([
            [AttributeSubgroup::MOVIES, 'Is your character known for %s?', 'Seu personagem é conhecido por %s?', [
                ['action movies', 'filmes de ação'],
                ['drama movies', 'filmes de drama'],
                ['award-winning performances', 'atuacoes premiadas'],
            ]],
            [AttributeSubgroup::TELEVISION, 'Is your character known in %s?', 'Seu personagem é conhecido na %s?', [
                ['tv series', 'série de TV'],
                ['talk shows', 'talk show'],
                ['prime-time shows', 'programas de horario nobre'],
                ['reality shows', 'reality show'],
            ]],
            [AttributeSubgroup::MUSIC, 'Is your character linked to %s?', 'Seu personagem está ligado a %s?', [
                ['pop music', 'música pop'],
                ['rock music', 'música rock'],
                ['live performances', 'apresentações ao vivo'],
                ['songwriting', 'composicao musical'],
                ['chart-topping songs', 'musicas de topo das paradas'],
                ['MPB', 'MPB'],
                ['sertanejo music', 'sertanejo'],
                ['samba', 'samba'],
                ['bossa nova', 'bossa nova'],
                ['axé music', 'axé'],
                ['forró music', 'forró'],
                ['pagode', 'pagode'],
            ]],
            [AttributeSubgroup::LITERATURE, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['novels', 'romances'],
                ['poetry', 'poesia'],
                ['writing as profession', 'escrita como profissao'],
                ['experimental prose', 'prosa experimental'],
                ['modernist literature', 'literatura modernista'],
                ['magical realism', 'realismo mágico'],
                ['short stories', 'contos'],
            ]],
            [AttributeSubgroup::SOCIAL_MEDIA, 'Is your character known for %s?', 'Seu personagem é conhecido por %s?', [
                ['short videos', 'videos curtos'],
                ['large follower counts', 'grande numero de seguidores'],
                ['memes', 'memes'],
            ]],
        ]);
    }

    private function accomplishments(): void
    {
        $this->seedGroups([
            [AttributeSubgroup::AWARDS, 'Has your character won %s?', 'Seu personagem ganhou %s?', [
                ['major international awards', 'prêmios internacionais importantes'],
                ['national awards', 'prêmios nacionais'],
            ]],
            [AttributeSubgroup::RECORDS, 'Does your character hold %s?', 'Seu personagem possui %s?', [
                ['a world record', 'recorde mundial'],
                ['a speed record', 'recorde de velocidade'],
                ['multiple records', 'múltiplos recordes'],
            ]],
            [AttributeSubgroup::ACCOMPLISHMENT_TITLES, 'Is your character known by %s?', 'Seu personagem é conhecido por %s?', [
                ['world champion title', 'título de campeão mundial'],
                ['legend title', 'título de lenda'],
            ]],
            [AttributeSubgroup::RECOGNITION, 'Has your character received %s?', 'Seu personagem recebeu %s?', [
                ['international recognition', 'reconhecimento internacional'],
                ['media recognition', 'reconhecimento da mídia'],
                ['public recognition', 'reconhecimento publico'],
                ['a historic level of recognition', 'um nivel historico de reconhecimento'],
            ]],
        ]);
    }

    private function history(): void
    {
        $this->seedGroups([
            [AttributeSubgroup::HISTORICAL_PERIOD, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['ancient history', 'história antiga'],
                ['modern history', 'história moderna'],
                ['contemporary history', 'história contemporânea'],
            ]],
            [AttributeSubgroup::HISTORICAL_EVENT, 'Was your character involved in %s?', 'Seu personagem esteve envolvido em %s?', [
                ['a major war', 'uma grande guerra'],
                ['a political transition', 'uma transição política'],
                ['a social movement', 'um movimento social'],
                ['a cultural milestone', 'um marco cultural'],
                ['political exile', 'exílio político'],
            ]],
            [AttributeSubgroup::HISTORICAL_ROLE, 'Did your character act as %s?', 'Seu personagem atuou como %s?', [
                ['a ruler', 'governante'],
                ['a military leader', 'lider militar'],
                ['a revolutionary', 'revolucionário'],
            ]],
            [AttributeSubgroup::HISTORICAL_IMPACT, 'Did your character have %s impact?', 'Seu personagem teve impacto %s?', [
                ['global', 'global'],
                ['national', 'nacional'],
                ['cultural', 'cultural'],
                ['long-term historical', 'histórico de longo prazo'],
            ]],
        ]);
    }

    private function geography(): void
    {
        $this->seedGroups([
            [AttributeSubgroup::CONTINENT, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['South America', 'América do Sul'],
                ['North America', 'América do Norte'],
                ['Europe', 'Europa'],
                ['Asia', 'Ásia'],
                ['Africa', 'África'],
            ]],
            [AttributeSubgroup::COUNTRY, 'Is your character linked to %s?', 'Seu personagem está ligado a %s?', [
                ['Brazil', 'Brasil'],
                ['United States', 'Estados Unidos'],
                ['Japan', 'Japão'],
                ['France', 'França'],
                ['Germany', 'Alemanha'],
            ]],
            [AttributeSubgroup::REGION, 'Is your character %s?', 'Seu personagem é %s?', [
                ['carioca', 'carioca'],
                ['baiano', 'baiano'],
                ['paulista', 'paulista'],
                ['gaúcho', 'gaúcho'],
            ]],
        ]);
    }

    private function fiction(): void
    {
        $this->seedGroups([
            [AttributeSubgroup::ALIGNMENT, 'Is your character %s?', 'Seu personagem %s?', [
                ['heroic', 'é heroico', SecondaryAttribute::ALIGNMENT_HEROIC],
                ['villainous', 'é vilanesco', SecondaryAttribute::ALIGNMENT_VILLAINOUS],
                ['morally gray', 'é moralmente cinza'],
            ]],
            [AttributeSubgroup::ROLE, 'Is your character primarily a %s?', 'Seu personagem é principalmente %s?', [
                ['protagonist', 'protagonista'],
                ['antagonist', 'antagonista'],
                ['mentor', 'mentor'],
            ]],
            [AttributeSubgroup::UNIVERSE, 'Is your character from %s?', 'Seu personagem é de %s?', [
                ['a superhero universe', 'um universo de super-herois'],
                ['an anime universe', 'um universo de anime'],
                ['a fantasy universe', 'um universo de fantasia'],
            ]],
        ]);
    }

    private function miscellaneous(): void
    {
        $this->seedGroups([
            [AttributeSubgroup::NICKNAMES, 'Is your character known by %s?', 'Seu personagem é conhecido por %s?', [
                ['a famous nickname', 'um apelido famoso'],
                ['a nickname used more than real name', 'apelido usado mais que nome real'],
            ]],
            [AttributeSubgroup::LEGAL, 'Has your character faced %s?', 'Seu personagem enfrentou %s?', [
                ['legal issues', 'problemas legais'],
                ['investigations', 'investigações'],
            ]],
            [AttributeSubgroup::CONTROVERSIES, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['public scandals', 'escândalos publicos'],
                ['polarizing opinions', 'opiniões polarizadas'],
                ['controversies', 'controversias'],
            ]],
            [AttributeSubgroup::COOKING, 'Does your character like %s?', 'Seu personagem gosta de %s?', [
                ['cooking at home', 'cozinhar em casa'],
            ]],
        ]);
    }
}

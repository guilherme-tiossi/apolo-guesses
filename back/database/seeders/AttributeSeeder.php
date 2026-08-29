<?php

namespace Database\Seeders;

use App\Core\Domain\Attributes\Enums\CategoryAttribute;
use App\Core\Domain\Attributes\Enums\SubcategoryAttribute;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use App\Core\Domain\Shared\Enums\CharacterCategory;
use App\Core\Domain\Shared\Enums\CharacterSubcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $this->categoryAreas();
        $this->subcategoryAreas();
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
        $this->linkCategoryAttributes();
        $this->linkSubcategoryAttributes();
    }

    private function categoryAreas(): void
    {
        $attributes = [];

        foreach (CharacterCategory::cases() as $category) {
            $attributes[] = [
                'category_id' => $category->value,
                'subcategory_id' => null,
                'question' => $category->questionEn(),
                'portuguese_question' => $category->questionPt(),
                'is_initial_question' => false,
                'is_secondary_question' => false,
                'internal_name' => $category->attribute()->value,
            ];
        }

        $this->seed($attributes);
    }

    private function linkCategoryAttributes(): void
    {
        foreach (CharacterCategory::cases() as $category) {
            $attributeId = DB::table('attributes')
                ->where('internal_name', CategoryAttribute::fromCategory($category)->value)
                ->value('id');

            DB::table('categories')
                ->where('id', $category->value)
                ->update(['attribute_id' => $attributeId]);
        }
    }

    private function subcategoryAreas(): void
    {
        $attributes = [];

        foreach (CharacterSubcategory::cases() as $subcategory) {
            $isReligion = $subcategory === CharacterSubcategory::RELIGION;

            $attributes[] = [
                'category_id' => $subcategory->category()->value,
                'subcategory_id' => $subcategory->value,
                'question' => $subcategory->questionEn(),
                'portuguese_question' => $subcategory->questionPt(),
                'is_initial_question' => false,
                'is_secondary_question' => $isReligion,
                'internal_name' => $subcategory->attribute()->value,
            ];
        }

        $this->seed($attributes);
    }

    private function linkSubcategoryAttributes(): void
    {
        foreach (CharacterSubcategory::cases() as $subcategory) {
            $attributeId = DB::table('attributes')
                ->where('internal_name', SubcategoryAttribute::fromSubcategory($subcategory)->value)
                ->value('id');

            DB::table('subcategories')
                ->where('id', $subcategory->value)
                ->update(['attribute_id' => $attributeId]);
        }
    }

    private function seed(array $attributes): void
    {
        foreach ($attributes as $attribute) {
            DB::table('attributes')->updateOrInsert(
                ['question' => $attribute['question']],
                [
                    'category_id' => $attribute['category_id'],
                    'subcategory_id' => $attribute['subcategory_id'],
                    'portuguese_question' => $attribute['portuguese_question'],
                    'is_initial_question' => $attribute['is_initial_question'],
                    'is_secondary_question' => $attribute['is_secondary_question'],
                    'internal_name' => $attribute['internal_name'],
                ]
            );
        }
    }

    private function template(
        ?CharacterCategory $category,
        ?CharacterSubcategory $subcategory,
        string $questionTemplate,
        string $portugueseTemplate,
        array $traits
    ): array {
        return array_map(function (array $trait) use ($category, $subcategory, $questionTemplate, $portugueseTemplate) {
            [
                'is_initial_question' => $isInitialQuestion,
                'is_secondary_question' => $isSecondaryQuestion,
                'internal_name' => $internalName,
            ] = $this->parseTraitFlags($trait);

            return [
                'category_id' => $category?->value,
                'subcategory_id' => $subcategory?->value,
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
        foreach ($groups as [$category, $subcategory, $questionTemplate, $portugueseTemplate, $traits]) {
            $attributes = array_merge(
                $attributes,
                $this->template($category, $subcategory, $questionTemplate, $portugueseTemplate, $traits)
            );
        }

        $this->seed($attributes);
    }

    private function appearance(): void
    {
        $this->seedGroups([
            [null, null, 'Is your character %s?', 'Seu personagem é %s?', [
                ['very tall', 'muito alto'],
                ['short', 'baixo'],
            ]],
            [null, null, 'Does your character look %s?', 'Seu personagem parece %s?', [
                ['slim', 'magro'],
                ['lean', 'em forma'],
                ['muscular', 'musculoso'],
                ['fat', 'gordo'],
            ]],
            [null, null, 'Does your character have %s skin?', 'Seu personagem tem pele %s?', [
                ['fair', 'clara'],
                ['dark', 'escura'],
            ]],
            [null, null, 'Does your character have %s hair?', 'Seu personagem tem cabelo %s?', [
                ['dark', 'escuro'],
                ['blond', 'loiro'],
                ['red', 'ruivo'],
                ['white', 'branco'],
                ['gray', 'grisalho'],
            ]],
            [null, null, 'Does your character have %s hair?', 'Seu personagem tem %s?', [
                ['short', 'cabelo curto'],
                ['long', 'cabelo longo'],
                ['no', 'a cabeça careca'],
            ]],
            [null, null, 'Is your character hair texture %s?', 'A textura do cabelo do seu personagem é %s?', [
                ['straight', 'lisa'],
                ['coily', 'crespa'],
            ]],
            [null, null, 'Does your character have %s?', 'Seu personagem tem %s?', [
                ['beard', 'barba'],
                ['a mustache', 'bigode'],
            ]],
            [null, null, 'Does your character have %s eyes?', 'Seu personagem tem olhos %s?', [
                ['dark', 'escuros'],
                ['light', 'claros'],
            ]],
            [null, null, 'Is your character %s?', 'Seu personagem é %s?', [
                ['human', 'humano'],
                ['mutant', 'mutante'],
                ['android', 'androide'],
                ['vampire', 'vampiro'],
            ]],
            [null, null, 'Does your character usually wear a %s style?', 'Seu personagem geralmente usa estilo %s?', [
                ['casual', 'casual'],
                ['formal', 'formal'],
                ['sporty', 'esportivo'],
                ['elegant', 'elegante'],
            ]],
            [null, null, 'Does your character have %s?', 'Seu personagem tem %s?', [
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
            [null, null, 'Is your character %s?', 'Seu personagem %s?', [
                ['a child', 'é criança', InitialAttribute::AGE_CHILD],
                ['a teenager', 'é adolescente', InitialAttribute::AGE_TEENAGER],
                ['an adult', 'é adulto', InitialAttribute::AGE_ADULT],
                ['over forty', 'está acima dos quarenta', InitialAttribute::AGE_OVER_FORTY],
                ['elderly', 'é idoso', InitialAttribute::AGE_ELDERLY],
            ]],
            [null, null, 'Is your character %s?', 'Seu personagem %s?', [
                ['male', 'é homem', InitialAttribute::GENDER_MALE],
                ['female', 'é mulher', InitialAttribute::GENDER_FEMALE],
            ]],
            [null, null, 'Is your character %s?', 'Seu personagem %s?', [
                ['Brazilian', 'é brasileiro', InitialAttribute::NATIONALITY_BRAZILIAN],
                ['American', 'é americano'],
                ['Japanese', 'é japonês'],
                ['British', 'é britânico'],
                ['French', 'é francês'],
                ['German', 'é alemão'],
                ['fictional', 'é fictício', InitialAttribute::NATIONALITY_FICTICIONAL],
            ]],
            [null, null, 'Is your character described as %s?', 'Seu personagem é descrito como %s?', [
                ['black', 'negro'],
                ['white', 'branco'],
                ['asian', 'asiático'],
                ['latino', 'latino'],
                ['indigenous', 'indígena'],
            ]],
            [null, null, 'Does your character %s?', 'Seu personagem %s?', [
                ['speak Portuguese', 'fala português'],
                ['speak English', 'fala inglês'],
                ['speak Spanish', 'fala espanhol'],
                ['speak with a strong accent', 'fala com sotaque forte'],
            ]],
            [null, null, 'Is your character known as %s?', 'Seu personagem é conhecido como %s?', [
                ['a king or queen', 'rei ou rainha'],
                ['a president', 'presidente'],
                ['a professor', 'professor'],
                ['a doctor', 'doutor'],
            ]],
            [null, null, 'Is your character %s?', 'Seu personagem %s?', [
                ['alive', 'está vivo', InitialAttribute::LIVING_ALIVE],
                ['deceased', 'está morto', InitialAttribute::LIVING_DECEASED],
            ]],
            [null, null, 'Did your character die in %s?', 'Seu personagem morreu em %s?', [
                ['tragic circumstances', 'circunstâncias trágicas'],
            ]],
            [CharacterCategory::RELIGION, CharacterSubcategory::RELIGION, 'Does your character identify as %s?', 'Seu personagem se identifica como %s?', [
                ['Christian', 'cristao', SecondaryAttribute::RELIGION_CHRISTIAN],
                ['Muslim', 'muçulmano', SecondaryAttribute::RELIGION_MUSLIM],
                ['Jewish', 'judeu', SecondaryAttribute::RELIGION_JEWISH],
                ['Buddhist', 'budista', SecondaryAttribute::RELIGION_BUDDHIST],
                ['atheist', 'ateu', SecondaryAttribute::RELIGION_ATHEIST],
                ['agnostic', 'agnóstico', SecondaryAttribute::RELIGION_AGNOSTIC],
            ]],
            [null, null, 'Does your character %s?', 'Seu personagem %s?', [
                ['have children', 'tem filhos'],
                ['come from a famous family', 'vem de familia famosa'],
            ]],
            [CharacterCategory::POLITICS_AND_MILITARY, CharacterSubcategory::POLITICS, 'Is your character %s?', 'Seu personagem %s?', [
                ['politically active', 'é politicamente ativo'],
                ['a conservative figure', 'é figura conservadora', SecondaryAttribute::POLITICAL_CONSERVATIVE],
                ['a progressive figure', 'é figura progressista', SecondaryAttribute::POLITICAL_PROGRESSIVE],
                ['an activist', 'é ativista'],
                ['a revolutionary', 'é revolucionário'],
            ]],
            [null, null, 'Does your character %s?', 'Seu personagem %s?', [
                ['have a university degree', 'tem diploma universitário'],
                ['be self-taught', 'é autodidata'],
                ['have formal military training', 'tem treinamento militar formal'],
            ]],
        ]);
    }

    private function personality(): void
    {
        $this->seedGroups([
            [null, null, 'Is your character %s?', 'Seu personagem %s?', [
                ['calm', 'é calmo'],
                ['aggressive', 'é agressivo'],
                ['impulsive', 'é impulsivo'],
                ['warm and friendly', 'é caloroso e amigável'],
            ]],
            [null, null, 'Is your character %s?', 'Seu personagem %s?', [
                ['analytical', 'é analítico'],
                ['street-smart', 'é esperto na pratica'],
                ['book-smart', 'é muito estudioso'],
                ['strategic', 'é estrategista'],
            ]],
            [null, null, 'Does your character %s?', 'Seu personagem %s?', [
                ['make jokes often', 'faz piadas com frequência'],
                ['laugh loudly', 'ri alto'],
            ]],
            [null, null, 'Does your character %s?', 'Seu personagem %s?', [
                ['lead a team', 'lidera um time'],
                ['inspire others', 'inspira os outros'],
                ['take command in crisis', 'assume comando em crises'],
                ['have followers', 'tem seguidores'],
            ]],
            [null, null, 'Is your character %s?', 'Seu personagem %s?', [
                ['morally upright', 'é moralmente correto'],
                ['morally gray', 'é moralmente cinza'],
                ['justice-driven', 'é movido por justiça'],
            ]],
            [null, null, 'Does your character live a %s lifestyle?', 'Seu personagem vive um estilo de vida %s?', [
                ['luxurious', 'luxuoso'],
                ['simple', 'simples'],
                ['urban', 'urbano'],
            ]],
        ]);
    }

    private function career(): void
    {
        $this->seedGroups([
            [null, null, 'Is your character a %s?', 'Seu personagem é %s?', [
                ['athlete', 'atleta'],
                ['doctor', 'médico'],
                ['lawyer', 'advogado'],
                ['teacher', 'professor'],
            ]],
            [CharacterCategory::ART, CharacterSubcategory::MUSIC, 'Is your character a %s?', 'Seu personagem é %s?', [
                ['singer', 'cantor'],
            ]],
            [CharacterCategory::ART, CharacterSubcategory::TV_AND_FILMS, 'Is your character active in %s?', 'Seu personagem atua em %s?', [
                ['cinema', 'cinema'],
                ['theater', 'teatro'],
            ]],
            [null, null, 'Does your character %s?', 'Seu personagem %s?', [
                ['own a company', 'é dono de empresa'],
                ['manage large teams', 'gerencia equipes grandes'],
                ['focus on sales', 'foca em vendas'],
            ]],
            [CharacterCategory::ART, CharacterSubcategory::TV_AND_FILMS, 'Does your character work mainly in %s?', 'Seu personagem trabalha principalmente com %s?', [
                ['cinema production', 'produção cinematográfica'],
            ]],
            [CharacterCategory::TELEVISION, CharacterSubcategory::TV_PRESENTATION, 'Is your character a %s?', 'Seu personagem é %s?', [
                ['TV personality', 'personalidade da TV'],
            ]],
            [CharacterCategory::TELEVISION, CharacterSubcategory::TV_PRESENTATION, 'Does your character work mainly in %s?', 'Seu personagem trabalha principalmente com %s?', [
                ['journalism', 'jornalismo'],
            ]],
            [CharacterCategory::FINANCE, CharacterSubcategory::FINANCE, 'Is your character a %s?', 'Seu personagem é %s?', [
                ['business leader', 'lider empresarial'],
            ]],
            [CharacterCategory::POLITICS_AND_MILITARY, CharacterSubcategory::POLITICS, 'Does your character serve/served in %s?', 'Seu personagem atua/atuou em %s?', [
                ['government office', 'cargo publico'],
                ['diplomacy', 'diplomacia'],
            ]],
        ]);
    }

    private function sports(): void
    {
        $this->seedGroups([
            [CharacterCategory::SPORT, CharacterSubcategory::FOOTBALL, 'Does your character %s?', 'Seu personagem %s?', [
                ['score many goals', 'marca muitos gols'],
                ['play in international tournaments', 'joga torneios internacionais'],
                ['be known for dribbling', 'é conhecido por dribles'],
            ]],
            [CharacterCategory::SPORT, CharacterSubcategory::OTHER_SPORTS, 'Does your character %s?', 'Seu personagem %s?', [
                ['play basketball professionally', 'joga basquete profissionalmente'],
                ['win basketball championships', 'vence campeonatos de basquete'],
            ]],
            [CharacterCategory::SPORT, CharacterSubcategory::OTHER_SPORTS, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['tennis', 'tênis'],
                ['olympic events', 'eventos olimpicos'],
                ['surfing', 'surfe'],
            ]],
            [CharacterCategory::SPORT, CharacterSubcategory::COMBAT, 'Does your character compete in %s?', 'Seu personagem compete em %s?', [
                ['boxing', 'boxe'],
                ['mma', 'mma'],
            ]],
            [CharacterCategory::SPORT, CharacterSubcategory::OTHER_SPORTS, 'Does your character %s?', 'Seu personagem %s?', [
                ['compete in esports', 'compete em esports'],
                ['be famous in gaming communities', 'é famoso em comunidades de games'],
            ]],
        ]);
    }

    private function entertainment(): void
    {
        $art = CharacterCategory::ART;
        $social = CharacterCategory::SOCIAL_MEDIA;

        $this->seedGroups([
            [$art, CharacterSubcategory::TV_AND_FILMS, 'Is your character known for %s?', 'Seu personagem é conhecido por %s?', [
                ['action movies', 'filmes de ação'],
                ['drama movies', 'filmes de drama'],
                ['award-winning performances', 'atuacoes premiadas'],
            ]],
            [$art, CharacterSubcategory::TV_AND_FILMS, 'Is your character known in %s?', 'Seu personagem é conhecido na %s?', [
                ['tv series', 'série de TV'],
            ]],
            [CharacterCategory::TELEVISION, CharacterSubcategory::TV_PRESENTATION, 'Is your character known in %s?', 'Seu personagem é conhecido na %s?', [
                ['talk shows', 'talk show'],
                ['prime-time shows', 'programas de horario nobre'],
                ['reality shows', 'reality show'],
            ]],
            [$art, CharacterSubcategory::MUSIC, 'Is your character linked to %s?', 'Seu personagem está ligado a %s?', [
                ['pop music', 'música pop'],
                ['rock music', 'música rock'],
                ['folk music', 'música folk'],
                ['indie music', 'música indie'],
                ['alternative rock', 'rock alternativo'],
                ['electronic music', 'música eletrônica'],
                ['hip hop music', 'hip hop'],
                ['R&B music', 'R&B'],
                ['punk rock', 'punk rock'],
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
            [$art, CharacterSubcategory::WRITING, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['novels', 'romances'],
                ['writing as profession', 'escrita como profissao'],
                ['experimental prose', 'prosa experimental'],
                ['modernist literature', 'literatura modernista'],
                ['magical realism', 'realismo mágico'],
                ['short stories', 'contos'],
            ]],
            [$social, CharacterSubcategory::SOCIAL_MEDIA, 'Is your character known for %s?', 'Seu personagem é conhecido por %s?', [
                ['short videos', 'videos curtos'],
                ['memes', 'memes'],
            ]],
        ]);
    }

    private function accomplishments(): void
    {
        $this->seedGroups([
            [null, null, 'Has your character won %s?', 'Seu personagem ganhou %s?', [
                ['major international awards', 'prêmios internacionais importantes'],
                ['national awards', 'prêmios nacionais'],
            ]],
            [null, null, 'Does your character hold %s?', 'Seu personagem possui %s?', [
                ['a world record', 'recorde mundial'],
                ['a speed record', 'recorde de velocidade'],
                ['multiple records', 'múltiplos recordes'],
            ]],
            [null, null, 'Is your character known by %s?', 'Seu personagem é conhecido por %s?', [
                ['world champion title', 'título de campeão mundial'],
                ['legend title', 'título de lenda'],
            ]],
            [null, null, 'Has your character received %s?', 'Seu personagem recebeu %s?', [
                ['international recognition', 'reconhecimento internacional'],
                ['media recognition', 'reconhecimento da mídia'],
                ['public recognition', 'reconhecimento publico'],
                ['a historic level of recognition', 'um nivel historico de reconhecimento'],
            ]],
        ]);
    }

    private function history(): void
    {
        $politics = CharacterCategory::POLITICS_AND_MILITARY;

        $this->seedGroups([
            [null, null, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['ancient history', 'história antiga'],
                ['modern history', 'história moderna'],
                ['contemporary history', 'história contemporânea'],
            ]],
            [null, null, 'Was your character involved in %s?', 'Seu personagem esteve envolvido em %s?', [
                ['a major war', 'uma grande guerra'],
                ['a political transition', 'uma transição política'],
                ['a social movement', 'um movimento social'],
                ['a cultural milestone', 'um marco cultural'],
                ['political exile', 'exílio político'],
            ]],
            [$politics, CharacterSubcategory::POLITICS, 'Did your character act as %s?', 'Seu personagem atuou como %s?', [
                ['a ruler', 'governante'],
                ['a revolutionary', 'revolucionário'],
            ]],
            [null, null, 'Did your character have %s impact?', 'Seu personagem teve impacto %s?', [
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
            [null, null, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['South America', 'América do Sul'],
                ['North America', 'América do Norte'],
                ['Europe', 'Europa'],
                ['Asia', 'Ásia'],
                ['Africa', 'África'],
            ]],
            [null, null, 'Is your character linked to %s?', 'Seu personagem está ligado a %s?', [
                ['Brazil', 'Brasil'],
                ['United States', 'Estados Unidos'],
                ['United Kingdom', 'Reino Unido'],
                ['Argentina', 'Argentina'],
                ['Canada', 'Canadá'],
                ['Iceland', 'Islândia'],
                ['Egypt', 'Egito'],
                ['Cuba', 'Cuba'],
                ['Japan', 'Japão'],
                ['France', 'França'],
                ['Germany', 'Alemanha'],
            ]],
            [null, null, 'Is your character %s?', 'Seu personagem é %s?', [
                ['carioca', 'carioca'],
                ['baiano', 'baiano'],
                ['paulista', 'paulista'],
                ['gaúcho', 'gaúcho'],
            ]],
        ]);
    }

    private function fiction(): void
    {
        $fiction = CharacterCategory::FICTION;

        $this->seedGroups([
            [$fiction, CharacterSubcategory::FICTION, 'Is your character %s?', 'Seu personagem %s?', [
                ['heroic', 'é heroico', SecondaryAttribute::ALIGNMENT_HEROIC],
                ['villainous', 'é vilanesco', SecondaryAttribute::ALIGNMENT_VILLAINOUS],
                ['morally gray', 'é moralmente cinza'],
            ]],
            [$fiction, CharacterSubcategory::FICTION, 'Is your character primarily a %s?', 'Seu personagem é principalmente %s?', [
                ['protagonist', 'protagonista'],
                ['antagonist', 'antagonista'],
                ['mentor', 'mentor'],
            ]],
            [$fiction, CharacterSubcategory::FICTION, 'Is your character from %s?', 'Seu personagem é de %s?', [
                ['a superhero universe', 'um universo de super-herois'],
                ['an anime universe', 'um universo de anime'],
                ['a fantasy universe', 'um universo de fantasia'],
            ]],
        ]);
    }

    private function miscellaneous(): void
    {
        $this->seedGroups([
            [null, null, 'Is your character known by %s?', 'Seu personagem é conhecido por %s?', [
                ['a famous nickname', 'um apelido famoso'],
                ['a nickname used more than real name', 'apelido usado mais que nome real'],
            ]],
            [null, null, 'Has your character faced %s?', 'Seu personagem enfrentou %s?', [
                ['legal issues', 'problemas legais'],
                ['investigations', 'investigações'],
            ]],
            [null, null, 'Is your character associated with %s?', 'Seu personagem está associado a %s?', [
                ['public scandals', 'escândalos publicos'],
                ['polarizing opinions', 'opiniões polarizadas'],
                ['controversies', 'controversias'],
            ]],
            [null, null, 'Does your character like %s?', 'Seu personagem gosta de %s?', [
                ['cooking at home', 'cozinhar em casa'],
            ]],
            [null, null, 'Did your character become famous in the %s?', 'Seu personagem ficou famoso na década de %s?', [
                ['1900s', '1900'],
                ['1910s', '1910'],
                ['1920s', '1920'],
                ['1930s', '1930'],
                ['1940s', '1940'],
                ['1950s', '1950'],
                ['1960s', '1960'],
                ['1970s', '1970'],
                ['1980s', '1980'],
                ['1990s', '1990'],
                ['2000s', '2000'],
                ['2010s', '2010'],
                ['2020s', '2020'],
            ]],
        ]);
    }
}

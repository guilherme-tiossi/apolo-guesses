<?php

namespace Tests\Feature\Core\Application\Answers\UseCases\PutAnswer;

use App\Core\Application\Answers\UseCases\GetAnswers\OutputDto as GetAnswersOutputDto;
use App\Core\Application\Answers\UseCases\PutAnswer\InputDto;
use App\Core\Application\Answers\UseCases\PutAnswer\PutAnswer;
use App\Core\Application\Characters\Services\CandidateDataGetter\CandidateAttributeDto;
use App\Core\Application\Characters\Services\CandidateDataGetter\CandidateDataGetter;
use App\Core\Application\Characters\Services\CandidateDataGetter\OutputDto as CandidateOutputDto;
use App\Core\Domain\Answers\Entities\Answer;
use App\Core\Domain\Attributes\Entities\Attribute as AttributeEntity;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Application\Answers\UseCases\GetAnswers\GetAnswers;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Character;
use App\Models\Player;
use App\Models\PlayerAnswer;
use App\Models\PlayerAttributeBlacklist;
use App\Models\PlayerCharacterBlacklist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class PutAnswerTest extends TestCase
{
    use RefreshDatabase;

    public function test_deve_criar_resposta_e_aplicar_opostos_e_atributos_ignorados(): void
    {
        $player = $this->createPlayer();
        $alive = $this->createAttribute(InitialAttribute::LIVING_ALIVE->value);
        $deceased = $this->createAttribute(InitialAttribute::LIVING_DECEASED->value);
        $adult = $this->createAttribute(InitialAttribute::AGE_ADULT->value);
        $child = $this->createAttribute(InitialAttribute::AGE_CHILD->value);
        $teenager = $this->createAttribute(InitialAttribute::AGE_TEENAGER->value);
        $elderly = $this->createAttribute(InitialAttribute::AGE_ELDERLY->value);

        $useCase = $this->makeUseCase(candidatesCount: 2);

        $result = $useCase->execute(new InputDto(
            playerId: $player->id,
            attributeId: $alive->id,
            answerScore: 0.5,
        ));

        self::assertNull($result);
        $this->assertDatabaseHas('player_answers', [
            'player_id' => $player->id,
            'attribute_id' => $alive->id,
            'answer_score' => 0.5,
        ]);
        $this->assertDatabaseHas('player_answers', [
            'player_id' => $player->id,
            'attribute_id' => $deceased->id,
            'answer_score' => 1.5,
        ]);

        foreach ([$adult, $child, $teenager, $elderly] as $attribute) {
            $this->assertDatabaseHas('player_attribute_blacklists', [
                'player_id' => $player->id,
                'attribute_id' => $attribute->id,
            ]);
        }
    }

    public function test_nao_deve_substituir_resposta_duplicada(): void
    {
        $player = $this->createPlayer();
        $attribute = $this->createAttribute('custom_attribute');

        PlayerAnswer::create([
            'player_id' => $player->id,
            'attribute_id' => $attribute->id,
            'answer_score' => 1.25,
        ]);

        $useCase = $this->makeUseCase();
        $result = $useCase->execute(new InputDto($player->id, $attribute->id, 1.25));

        self::assertNull($result);
        self::assertSame(1, PlayerAnswer::where('player_id', $player->id)->count());
    }

    public function test_deve_criar_respostas_de_atributo_sem_nome_interno_sem_aplicar_efeitos_colaterais(): void
    {
        $player = $this->createPlayer();
        $attribute = $this->createAttribute(null);
        $character = $this->createCharacter();
        $useCase = $this->makeUseCase($character->id, 1, 25);

        $result = $useCase->execute(new InputDto($player->id, $attribute->id, 2.0));

        self::assertNotNull($result);
        self::assertSame((string) $character->id, $result->characterId);
        $this->assertDatabaseHas('player_answers', [
            'player_id' => $player->id,
            'attribute_id' => $attribute->id,
            'answer_score' => 2.0,
        ]);
        self::assertSame(0, PlayerAttributeBlacklist::where('player_id', $player->id)->count());
        self::assertSame(0, PlayerAnswer::where('player_id', $player->id)
            ->where('attribute_id', '!=', $attribute->id)
            ->count());
    }

    public function test_deve_preservar_resposta_do_atributo_oposto_ja_existente(): void
    {
        $player = $this->createPlayer();
        $alive = $this->createAttribute(InitialAttribute::LIVING_ALIVE->value);
        $deceased = $this->createAttribute(InitialAttribute::LIVING_DECEASED->value);

        PlayerAnswer::create([
            'player_id' => $player->id,
            'attribute_id' => $deceased->id,
            'answer_score' => 0.25,
        ]);

        $useCase = $this->makeUseCase(candidatesCount: 2);
        $useCase->execute(new InputDto($player->id, $alive->id, 1.0));

        self::assertSame(1, PlayerAnswer::where([
            'player_id' => $player->id,
            'attribute_id' => $deceased->id,
        ])->count());
        $this->assertDatabaseHas('player_answers', [
            'player_id' => $player->id,
            'attribute_id' => $deceased->id,
            'answer_score' => 0.25,
        ]);
    }

    public function test_deve_reverter_resposta_e_seus_efeitos_colaterais(): void
    {
        $player = $this->createPlayer();
        $alive = $this->createAttribute(InitialAttribute::LIVING_ALIVE->value);
        $deceased = $this->createAttribute(InitialAttribute::LIVING_DECEASED->value);
        $adult = $this->createAttribute(InitialAttribute::AGE_ADULT->value);
        $character = $this->createCharacter();

        PlayerAnswer::create([
            'player_id' => $player->id,
            'attribute_id' => $alive->id,
            'answer_score' => 0.5,
        ]);
        PlayerAnswer::create([
            'player_id' => $player->id,
            'attribute_id' => $deceased->id,
            'answer_score' => 1.5,
        ]);
        PlayerAttributeBlacklist::create([
            'player_id' => $player->id,
            'attribute_id' => $adult->id,
        ]);
        PlayerCharacterBlacklist::create([
            'player_id' => $player->id,
            'character_id' => $character->id,
        ]);

        $this->makeUseCase()->revert($player->id, $alive->id);

        self::assertDatabaseMissing('player_answers', [
            'player_id' => $player->id,
            'attribute_id' => $alive->id,
        ]);
        self::assertDatabaseMissing('player_answers', [
            'player_id' => $player->id,
            'attribute_id' => $deceased->id,
            'answer_score' => 1.5,
        ]);
        self::assertDatabaseMissing('player_attribute_blacklists', [
            'player_id' => $player->id,
            'attribute_id' => $adult->id,
        ]);
        self::assertDatabaseMissing('player_character_blacklists', [
            'player_id' => $player->id,
            'character_id' => $character->id,
        ]);
    }

    public function test_revert_deve_ignorar_resposta_inexistente(): void
    {
        $player = $this->createPlayer();

        $this->makeUseCase()->revert($player->id, 999);

        self::assertSame(0, PlayerAnswer::where('player_id', $player->id)->count());
    }

    public function test_deve_retornar_personagem_somente_com_um_candidato_e_ao_menos_25_respostas(): void
    {
        $player = $this->createPlayer();
        $attribute = $this->createAttribute(null);
        $character = $this->createCharacter();
        $useCase = $this->makeUseCase($character->id, 1, 25);

        $result = $useCase->execute(new InputDto($player->id, $attribute->id, 1.0));

        self::assertNotNull($result);
        self::assertSame((string) $character->id, $result->characterId);
    }

    public function test_nao_deve_retornar_personagem_com_menos_de_25_respostas(): void
    {
        $player = $this->createPlayer();
        $attribute = $this->createAttribute(null);
        $character = $this->createCharacter();
        $useCase = $this->makeUseCase($character->id, 1, 24);

        $result = $useCase->execute(new InputDto($player->id, $attribute->id, 1.0));

        self::assertNull($result);
    }

    private function makeUseCase(?int $characterId = null, int $candidatesCount = 0, int $answersCount = 0): PutAnswer
    {
        $getAnswers = Mockery::mock(GetAnswers::class);
        $getAnswers->shouldReceive('execute')->andReturn(new GetAnswersOutputDto(
            answers: array_fill(0, $answersCount, new Answer(
                playerId: '1',
                attribute: new AttributeEntity(1, 'question', 'pergunta', null),
                value: 1.0,
            )),
        ));

        $candidateDataGetter = Mockery::mock(CandidateDataGetter::class);
        $candidateDataGetter->shouldReceive('execute')->andReturn(new CandidateOutputDto(
            candidatesAttributes: $characterId === null
                ? []
                : [new CandidateAttributeDto($characterId, 1)],
            candidatesCount: $candidatesCount,
        ));

        return new PutAnswer($getAnswers, $candidateDataGetter);
    }

    private function createAttribute(?string $internalName): Attribute
    {
        $attribute = new Attribute();
        $attribute->forceFill([
            'question' => "question_{$internalName}_" . uniqid(),
            'portuguese_question' => 'pergunta',
            'internal_name' => $internalName,
            'is_initial_question' => $internalName !== null,
            'is_secondary_question' => false,
        ]);
        $attribute->timestamps = false;
        $attribute->save();

        return $attribute;
    }

    private function createPlayer(): Player
    {
        return Player::create(['possible_characters_count' => 0]);
    }

    private function createCharacter(): Character
    {
        $category = new Category();
        $category->forceFill(['name' => 'categoria_' . uniqid()]);
        $category->timestamps = false;
        $category->save();

        $character = new Character();
        $character->forceFill([
            'name' => 'personagem_' . uniqid(),
            'category_id' => $category->id,
        ]);
        $character->timestamps = false;
        $character->save();

        return $character;
    }
}

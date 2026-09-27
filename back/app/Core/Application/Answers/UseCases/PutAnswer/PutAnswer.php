<?php

namespace App\Core\Application\Answers\UseCases\PutAnswer;


use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use App\Core\Domain\Attributes\Services\AttributeOppositionPolicy;
use App\Models\Attribute;
use App\Models\PlayerAnswer;
use App\Core\Application\Characters\Services\CandidateDataGetter\InputDto as CandidateDataGetterDto;
use App\Core\Application\Characters\Services\CandidateDataGetter\CandidateDataGetter;
use App\Models\Character;
use App\Core\Application\Answers\UseCases\GetAnswers\GetAnswers;
use App\Core\Application\Answers\UseCases\GetAnswers\InputDto as GetAnswersDto;
use App\Core\Domain\Attributes\Services\AttributeIgnorancePolicy;
use App\Models\PlayerAttributeBlacklist;
use App\Models\PlayerCharacterBlacklist;

class PutAnswer
{
    public function __construct(
        private GetAnswers $getAnswers,
        private CandidateDataGetter $candidateDataGetter
    ) {
    }

    private const MAX_ANSWER_SCORE = 2;

    public function execute(InputDto $input): ?OutputDto
    {
        $answerScore = $input->answerScore;

        $existingAnswer = PlayerAnswer::where([
            'player_id' => $input->playerId,
            'attribute_id' => $input->attributeId,
            'answer_score' => $answerScore
        ])->exists();

        if ($existingAnswer) {
            return null;
        }

        PlayerAnswer::create([
            'player_id' => $input->playerId,
            'attribute_id' => $input->attributeId,
            'answer_score' => $answerScore
        ]);

        $attribute = Attribute::where(['id' => $input->attributeId])->first();

        if (!$attribute->internal_name) {
            $characterId = $this->tryToGetCharacter($input->playerId);
            return $characterId ? new OutputDto(
                characterId: $characterId) : null;
        }

        $this->applySideEffects($input->playerId, $attribute, $answerScore);

        $characterId = $this->tryToGetCharacter($input->playerId);
        return $characterId ? new OutputDto(
            characterId: $characterId) : null;
    }

    public function revert(int $playerId, int $attributeId): void
    {
        $answer = PlayerAnswer::where([
            'player_id' => $playerId,
            'attribute_id' => $attributeId,
        ])->first();

        if (!$answer) {
            return;
        }

        $attribute = Attribute::find($attributeId);

        if ($attribute?->internal_name) {
            $this->revertSideEffects($playerId, $attribute, $answer->answer_score);
        }

        PlayerCharacterBlacklist::where('player_id', $playerId)->delete();

        $answer->delete();
    }

    private function applySideEffects(int $playerId, Attribute $attribute, float $answerScore): void
    {
        $attributeEnum = InitialAttribute::tryFrom($attribute->internal_name)
            ?? SecondaryAttribute::tryFrom($attribute->internal_name);

        if (!$attributeEnum) {
            return;
        }

        $opposites = AttributeOppositionPolicy::oppositesOf($attributeEnum, $answerScore);

        foreach ($opposites as $oppositeEnum) {
            $oppositeAttribute = Attribute::where(['internal_name' => $oppositeEnum->value])->first();
            $existingOppositeAnswer = PlayerAnswer::where([
                'player_id' => $playerId,
                'attribute_id' => $oppositeAttribute->id,
            ])->exists();

            if ($existingOppositeAnswer) {
                continue;
            }

            PlayerAnswer::create([
                'player_id' => $playerId,
                'attribute_id' => $oppositeAttribute->id,
                'answer_score' => self::MAX_ANSWER_SCORE - $answerScore
            ]);
        }

        $redundantAttributes = AttributeIgnorancePolicy::shouldIgnore($attributeEnum, $answerScore);

        foreach ($redundantAttributes as $redundantEnum) {
            $redundantAttribute = Attribute::where(['internal_name' => $redundantEnum->value])->first();

            PlayerAttributeBlacklist::create([
                'player_id' => $playerId,
                'attribute_id' => $redundantAttribute->id,
            ]);
        }
    }

    private function revertSideEffects(int $playerId, Attribute $attribute, float $answerScore): void
    {
        $attributeEnum = InitialAttribute::tryFrom($attribute->internal_name)
            ?? SecondaryAttribute::tryFrom($attribute->internal_name);

        if (!$attributeEnum) {
            return;
        }

        $opposites = AttributeOppositionPolicy::oppositesOf($attributeEnum, $answerScore);

        foreach ($opposites as $oppositeEnum) {
            $oppositeAttribute = Attribute::where(['internal_name' => $oppositeEnum->value])->first();

            if (!$oppositeAttribute) {
                continue;
            }

            PlayerAnswer::where([
                'player_id' => $playerId,
                'attribute_id' => $oppositeAttribute->id,
                'answer_score' => self::MAX_ANSWER_SCORE - $answerScore,
            ])->delete();
        }

        $redundantAttributes = AttributeIgnorancePolicy::shouldIgnore($attributeEnum, $answerScore);

        foreach ($redundantAttributes as $redundantEnum) {
            $redundantAttribute = Attribute::where(['internal_name' => $redundantEnum->value])->first();

            if (!$redundantAttribute) {
                continue;
            }

            PlayerAttributeBlacklist::where([
                'player_id' => $playerId,
                'attribute_id' => $redundantAttribute->id,
            ])->delete();
        }
    }

    private function tryToGetCharacter(int $playerId): ?string
    {
        $answers = $this->getAnswers->execute(new GetAnswersDto(
            playerId: $playerId
        ))->answers;

        $characterAttributeData = $this->candidateDataGetter->execute(new CandidateDataGetterDto(
            playerId: $playerId,
            answers: $answers
        ));

        if ($characterAttributeData->candidatesCount == 1 && count($answers) >= 25) {
            $character = Character::find($characterAttributeData->candidatesAttributes[0]->characterId);
            return $character->id;
        }

        return null;
    }
}

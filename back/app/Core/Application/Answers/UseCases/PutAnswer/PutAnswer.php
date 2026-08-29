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

        $attributeEnum = InitialAttribute::tryFrom($attribute->internal_name)
            ?? SecondaryAttribute::tryFrom($attribute->internal_name);

        if (!$attributeEnum) {
            return null;
        }

        $opposites = AttributeOppositionPolicy::oppositesOf($attributeEnum, $answerScore);

        foreach ($opposites as $oppositeEnum) {
            $oppositeAttribute = Attribute::where(['internal_name' => $oppositeEnum->value])->first();
            $existingOppositeAnswer = PlayerAnswer::where([
                'player_id' => $input->playerId,
                'attribute_id' => $oppositeAttribute->id,
            ])->exists();

            if ($existingOppositeAnswer) {
                continue;
            }

            PlayerAnswer::create([
                'player_id' => $input->playerId,
                'attribute_id' => $oppositeAttribute->id,
                'answer_score' => self::MAX_ANSWER_SCORE - $answerScore // if is_blonde = 1.75, is_redhead must equal 0.25
            ]);
        }

        $redundantAttributes = AttributeIgnorancePolicy::shouldIgnore($attributeEnum, $answerScore);

        foreach ($redundantAttributes as $redundantEnum) {
            $redundantAttribute = Attribute::where(['internal_name' => $redundantEnum->value])->first();

            PlayerAttributeBlacklist::create([
                'player_id' => $input->playerId,
                'attribute_id' => $redundantAttribute->id,
            ]);
        }

        $characterId = $this->tryToGetCharacter($input->playerId);
        return $characterId ? new OutputDto(
            characterId: $characterId) : null;
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

        if ($characterAttributeData->candidatesCount == 1) {
            $character = Character::find($characterAttributeData->candidatesAttributes[0]->characterId);
            return $character->id;
        }

        return null;
    }
}
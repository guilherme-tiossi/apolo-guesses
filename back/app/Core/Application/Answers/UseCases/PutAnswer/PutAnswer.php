<?php

namespace App\Core\Application\Answers\UseCases\PutAnswer;


use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use App\Core\Domain\Attributes\Services\AttributeOppositionPolicy;
use App\Models\Attribute;
use App\Models\PlayerAnswer;
use App\Core\Application\Characters\Services\CandidateAttributesGetter\InputDto as CandidateAttributesGetterDto;
use App\Core\Application\Characters\Services\CandidateAttributesGetter\CandidateAttributesGetter;
use App\Models\Character;

class PutAnswer
{
    public function __construct(
        private CandidateAttributesGetter $candidateAttributesGetter
    ) {
    }

    private const MAX_ANSWER_SCORE = 2;

    public function execute(InputDto $input): ?OutputDto
    {
        $answerScore = $input->answerScore;
        $answerPositive = $answerScore >= 1.50;
        $answerNegative = $answerScore <= 0.50;

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

        if (!$answerNegative && !$answerPositive) {
            return null;
        }

        // transformar em repositório se fizer sentido
        $attribute = Attribute::where(['id' => $input->attributeId])->first();

        if (!$attribute->internal_name) {
            $characterName = $this->tryToGetCharacter($input->playerId);
            return $characterName ? new OutputDto(
                characterName: $characterName) : null;
        }

        $attributeEnum = InitialAttribute::tryFrom($attribute->internal_name)
            ?? SecondaryAttribute::tryFrom($attribute->internal_name);
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

        $characterName = $this->tryToGetCharacter($input->playerId);
        return $characterName ? new OutputDto(
            characterName: $characterName) : null;
    }

    private function tryToGetCharacter(int $userId): ?string
    {
        $characterAttributeData = $this->candidateAttributesGetter->execute(new CandidateAttributesGetterDto(
            playerId: $userId
        ));

        if ($characterAttributeData->candidatesCount == 1) {
            $character = Character::find($characterAttributeData->candidatesAttributes[0]->character_id);
            return $character->name;
        }

        return null;
    }
}
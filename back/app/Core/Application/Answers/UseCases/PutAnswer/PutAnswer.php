<?php

namespace App\Core\Application\Answers\UseCases\PutAnswer;


use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use App\Core\Domain\Attributes\Services\AttributeOppositionPolicy;
use App\Models\Attribute;
use App\Models\TemporaryUserAnswer;

class PutAnswer
{
    private const MAX_ANSWER_SCORE = 2;

    public function execute(InputDto $input): void
    {
        $answerScore = $input->answerScore;
        $answerPositive = $answerScore >= 1.50;
        $answerNegative = $answerScore <= 0.50;

        TemporaryUserAnswer::create([
            'temporary_user_id' => $input->temporaryUserId,
            'attribute_id' => $input->attributeId,
            'answer_score' => $answerScore
        ]);

        if (!$answerNegative && !$answerPositive) {
            return;
        }

        // transformar em repositório se fizer sentido
        $attribute = Attribute::where(['id' => $input->attributeId])->first();
        if (!$attribute->internal_name) {
            return;
        }

        $attributeEnum = InitialAttribute::tryFrom($attribute->internal_name)
            ?? SecondaryAttribute::tryFrom($attribute->internal_name);
        $opposites = AttributeOppositionPolicy::oppositesOf($attributeEnum);
        
        foreach ($opposites as $oppositeEnum) {
            $oppositeAttribute = Attribute::where(['internal_name' => $oppositeEnum->value])->first();

            TemporaryUserAnswer::create([
                'temporary_user_id' => $input->temporaryUserId,
                'attribute_id' => $oppositeAttribute->id,
                'answer_score' => self::MAX_ANSWER_SCORE - $answerScore // if is_blonde = 1.75, is_redhead must equal 0.25
            ]);
        }
    }
}
<?php

namespace App\Core\Application\Attributes\Services\GetQuestion;

use App\Core\Application\Characters\Services\CandidateDataGetter\CandidateDataGetter;
use App\Core\Application\Characters\Services\CandidateDataGetter\InputDto as CandidateDataGetterDto;
use App\Core\Application\Answers\UseCases\GetAnswers\GetAnswers;
use App\Core\Application\Answers\UseCases\GetAnswers\InputDto as GetAnswersDto;
use App\Core\Domain\Shared\Enums\CharacterCategory;
use App\Core\Domain\Shared\Enums\CharacterSubcategory;
use App\Models\Attribute;
use Exception;

class CategoryQuestionGetter implements QuestionGetter
{
    public function __construct(
        private GetAnswers $getAnswers,
        private CandidateDataGetter $candidateDataGetter
    ) {
    }

    public function execute(InputDto $dto): OutputDto
    {
        if (!$dto->playerId) {
            throw new Exception('Usuário não encontrado', 500);
        }

        $answers = $this->getAnswers->execute(new GetAnswersDto(
            playerId: $dto->playerId
        ))->answers;

        $positiveAttributes = array_map(function ($answer) {
            $attribute = $answer->attribute;
            if ($answer->value > 1) {
                return $attribute->id;
            }
            return null;
        }, $answers);

        $mainCategoryFound = array_intersect($positiveAttributes, array_column(CharacterCategory::cases(), 'value'));
        $attributesToSearch = array_column($mainCategoryFound ? CharacterSubcategory::attributeIds() : CharacterCategory::attributeIds(), 'attributeId');

        $characterAttributeData = $this->candidateDataGetter->execute(new CandidateDataGetterDto(
            playerId: $dto->playerId,
            answers: $answers,
            attributesIn: $attributesToSearch
        ))->candidatesAttributes;

        if (empty($characterAttributeData)) {
            throw new Exception('Personagem não encontrado', 500);
        }

        $popularCategory = $this->getFrequentNonAnsweredCategory(
            $characterAttributeData,
            $answers
        );

        return new OutputDto(
            question: $popularCategory->portuguese_question,
            attributeId: $popularCategory->id,
            playerId: $dto->playerId
        );
    }

    private function getFrequentNonAnsweredCategory(array $attributeData, array $answers): Attribute
    {
        $answeredAttributesById = [];
        foreach ($answers as $answer) {
            $answeredAttributesById[$answer->attribute->id] = $answer->attribute;
        }

        $attributeFrequency = [];
        foreach ($attributeData as $attribute) {
            if (isset($answeredAttributesById[$attribute->attributeId])) {
                continue;
            }

            if (!in_array($attribute->attributeId, CharacterCategory::attributeIds())
                && !in_array($attribute->attributeId, CharacterSubcategory::attributeIds())) {
                continue;
            }

            if (!isset($attributeFrequency[$attribute->attributeId])) {
                $attributeFrequency[$attribute->attributeId] = 1;
                continue;
            }
            $attributeFrequency[$attribute->attributeId] += 1;
        }

        arsort($attributeFrequency);
        $frequentAttributeId = array_key_first($attributeFrequency);

        return Attribute::find($frequentAttributeId);
    }
}
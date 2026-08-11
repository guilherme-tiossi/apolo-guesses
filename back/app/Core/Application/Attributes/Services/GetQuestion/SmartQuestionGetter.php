<?php

namespace App\Core\Application\Attributes\Services\GetQuestion;

use App\Core\Application\Characters\Services\CandidateDataGetter\CandidateDataGetter;
use App\Core\Application\Characters\Services\CandidateDataGetter\InputDto as CandidateDataGetterDto;
use App\Core\Application\Answers\UseCases\GetAnswers\GetAnswers;
use App\Core\Application\Answers\UseCases\GetAnswers\InputDto as GetAnswersDto;
use App\Models\Attribute;
use Exception;

class SmartQuestionGetter implements QuestionGetter
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

        $characterAttributeData = $this->candidateDataGetter->execute(new CandidateDataGetterDto(
            playerId: $dto->playerId,
            answers: $answers
        ))->candidatesAttributes;

        if (empty($characterAttributeData)) {
            throw new Exception('Personagem não encontrado', 500);
        }

        $controversialAttribute = $this->getControversialNonAnsweredAttribute(
            $characterAttributeData,
            $answers
        );

        return new OutputDto(
            question: $controversialAttribute->portuguese_question,
            attributeId: $controversialAttribute->id,
            playerId: $dto->playerId
        );
    }

    private function getControversialNonAnsweredAttribute(array $attributeData, array $answers): Attribute
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

            if (!isset($attributeFrequency[$attribute->attributeId])) {
                $attributeFrequency[$attribute->attributeId] = 1;
                continue;
            }
            $attributeFrequency[$attribute->attributeId] += 1;
        }

        asort($attributeFrequency);

        $attributesFrequencyFirstHalf = array_slice(
            $attributeFrequency,
            0,
            count($attributeFrequency) / 2,
            true
        );
        $controversialAttributeId = array_key_last($attributesFrequencyFirstHalf);

        return Attribute::find($controversialAttributeId);
    }
}
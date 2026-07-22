<?php

namespace App\Core\Application\Attributes\Services\GetQuestion;

use App\Core\Application\Characters\Services\CandidateAttributesGetter\CandidateAttributesGetter;
use App\Core\Application\Characters\Services\CandidateAttributesGetter\InputDto as CandidateAttributesGetterDto;
use App\Models\Attribute;
use Exception;

class SmartQuestionGetter implements QuestionGetter
{
    public function __construct(
        private CandidateAttributesGetter $candidateAttributesGetter
    ) {
    }

    public function execute(InputDto $dto): OutputDto
    {
        if (!$dto->userId) {
            throw new Exception('Usuário não encontrado', 500);
        }

        $characterAttributeData = $this->candidateAttributesGetter->execute(new CandidateAttributesGetterDto(
            temporaryUserId: $dto->userId
        ))->candidatesAttributes;

        if (empty($characterAttributeData)) {
            throw new Exception('Personagem não encontrado', 500);
        }

        $controversialAttribute = $this->getControversialAttribute($characterAttributeData);

        return new OutputDto(
            question: $controversialAttribute->portuguese_question,
            attributeId: $controversialAttribute->id,
            temporaryUserId: $dto->userId
        );
    }

    private function getControversialAttribute(array $attributeData): Attribute
    {
        $attributeFrequency = [];

        foreach ($attributeData as $attribute) {
            if (!isset($attributeFrequency[$attribute->attribute_id])) {
                $attributeFrequency[$attribute->attribute_id] = 1;
                continue;
            }
            $attributeFrequency[$attribute->attribute_id] += 1;
        }

        asort($attributeFrequency);

        $attributeCount = count($attributeFrequency);
        $controversialAttributePosition = (int) ($attributeCount - 1 / 2);
        $controversialAttribute = $attributeData[$controversialAttributePosition];

        return Attribute::find($controversialAttribute->attribute_id);
    }
}
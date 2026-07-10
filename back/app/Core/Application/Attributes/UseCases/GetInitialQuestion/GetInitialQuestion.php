<?php

namespace App\Core\Application\Attributes\UseCases\GetInitialQuestion;

use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Models\Attribute;
use Exception;
use App\Core\Application\Answers\UseCases\GetAnswers\InputDto as GetAnswersDto;
use App\Core\Application\Answers\UseCases\GetAnswers\GetAnswers;
use App\Core\Application\TemporaryUser\Services\CreateTemporaryUser\CreateTemporaryUser;

class GetInitialQuestion {

    public function __construct(
        private CreateTemporaryUser $createTemporaryUser,
        private GetAnswers $getAnswers
    ) {
    }

    public function execute(InputDto $dto): OutputDto
    {
        $userId = $dto->userId ?? $this->createTemporaryUser->execute()->userId;
        $previousAnswers = $this->getAnswers->execute(new GetAnswersDto(userId: $userId))->answers;

        if (empty($previousAnswers)) {
            $attributeEnum = random_int(1,2) % 2 == 0 ? InitialAttribute::GENDER_FEMALE : InitialAttribute::GENDER_MALE;
            $attribute = $this->getAttribute($attributeEnum);
            return new OutputDto(
                question: $attribute->portuguese_question,
                attributeId: $attribute->id,
                temporaryUserId: $userId
            );
        }

        if (count($previousAnswers) < count(InitialAttribute::cases())) {
            foreach (InitialAttribute::cases() as $attributeEnum) {
                if (!in_array($attributeEnum, $this->getAnsweredAttributeEnums($previousAnswers))) {
                    $attribute = $this->getAttribute($attributeEnum);
                    return new OutputDto(
                        question: $attribute->portuguese_question,
                        attributeId: $attribute->id,
                        temporaryUserId: $userId
                    );
                }
            }
        }

        throw new Exception('Suporte apenas para questões iniciais por enquanto', 500);
    }

    private function getAttribute(InitialAttribute $attribute): Attribute
    {
        return Attribute::where('internal_name', $attribute->value)->first();
    }
    
    private function getAnsweredAttributeEnums(array $answers): array
    {
        $attributes = [];
        foreach ($answers as $answer) {
            if (!$answer->attribute->enum) {
                continue;
            }
            $attributes[] = $answer->attribute->enum;
        }

        return $attributes;
    }
}
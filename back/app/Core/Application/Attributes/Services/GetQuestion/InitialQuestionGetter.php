<?php

namespace App\Core\Application\Attributes\Services\GetQuestion;

use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Models\Attribute;
use Exception;
use App\Core\Application\Answers\UseCases\GetAnswers\InputDto as GetAnswersDto;
use App\Core\Application\Answers\UseCases\GetAnswers\GetAnswers;
use App\Core\Application\Attributes\Services\GetBlacklistedAttributes\GetBlacklistedAttributes;
use App\Core\Application\Attributes\Services\GetBlacklistedAttributes\InputDto as BlacklistedAttributesDto;
use App\Core\Application\Player\Services\CreatePlayer\CreatePlayer;

class InitialQuestionGetter implements QuestionGetter
{
    public function __construct(
        private CreatePlayer $createPlayer,
        private GetAnswers $getAnswers,
        private GetBlacklistedAttributes $getBlacklistedAttributes
    ) {
    }

    public function execute(InputDto $dto): OutputDto
    {
        $playerId = $dto->playerId ?? $this->createPlayer->execute()->playerId;
        $previousAnswers = $this->getAnswers->execute(new GetAnswersDto(playerId: $playerId))->answers;

        if (empty($previousAnswers)) {
            $attributeEnum = random_int(1,2) % 2 == 0 ? InitialAttribute::GENDER_FEMALE : InitialAttribute::GENDER_MALE;
            $attribute = $this->getAttribute($attributeEnum);
            return new OutputDto(
                question: $attribute->portuguese_question,
                attributeId: $attribute->id,
                playerId: $playerId
            );
        }

        $blacklistedAttributesByEnum = $this->getBlacklistedAttributesByEnum($playerId);

        foreach (InitialAttribute::cases() as $attributeEnum) {
            if (in_array($attributeEnum, $this->getAnsweredAttributeEnums($previousAnswers))) {
                continue;
            }

            if (!empty($blacklistedAttributesByEnum[$attributeEnum->value])) {
                continue;
            }

            $attribute = $this->getAttribute($attributeEnum);
            return new OutputDto(
                question: $attribute->portuguese_question,
                attributeId: $attribute->id,
                playerId: $playerId
            );
        }

        // appexception no futuro
        throw new Exception('Nenhum atributo encontrado :(', 404);
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

    private function getBlacklistedAttributesByEnum(int $playerId): array
    {
        $blacklistedAttributes = $this->getBlacklistedAttributes->execute(
            new BlacklistedAttributesDto(
                playerId: $playerId
            )
        )->attributes;

        $blacklistedAttributesByEnum = [];
        foreach ($blacklistedAttributes as $attribute) {
            $blacklistedAttributesByEnum[$attribute->enum->value] = true;
        }

        return $blacklistedAttributesByEnum;
    }
}
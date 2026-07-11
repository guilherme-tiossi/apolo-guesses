<?php

namespace App\Core\Application\Attributes\UseCases\GetQuestion;

use App\Core\Application\Attributes\Factories\QuestionGetterFactory\InputDto as QuestionGetterInputDto;
use App\Core\Application\Attributes\Factories\QuestionGetterFactory\QuestionGetterFactory;
use App\Core\Application\Attributes\Services\GetQuestion\InputDto as GetQuestionInputDto;
use App\Core\Application\Attributes\Services\GetQuestion\OutputDto;

class GetQuestion
{
    public function __construct(
        private QuestionGetterFactory $questionGetterFactory
    ) {
    }

    public function execute(InputDto $dto): OutputDto
    {
        $questionGetter = $this->questionGetterFactory->create(new QuestionGetterInputDto(
            temporaryUserId: $dto->temporaryUserId
        ));

        return $questionGetter->execute(new GetQuestionInputDto(
            userId: $dto->temporaryUserId
        ));
    }
}
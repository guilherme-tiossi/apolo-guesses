<?php

namespace App\Core\Application\Attributes\Services\GetQuestion;

use Exception;

class SmartQuestionGetter implements QuestionGetter
{

    public function execute(InputDto $dto): OutputDto
    {
        throw new Exception('Suporte apenas para questões iniciais por enquanto', 500);
    }
}
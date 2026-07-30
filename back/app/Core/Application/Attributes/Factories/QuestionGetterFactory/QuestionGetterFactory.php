<?php

namespace App\Core\Application\Attributes\Factories\QuestionGetterFactory;

use App\Core\Application\Attributes\Services\GetQuestion\InitialQuestionGetter;
use App\Core\Application\Attributes\Services\GetQuestion\SmartQuestionGetter;
use App\Core\Application\Attributes\Services\GetQuestion\QuestionGetter;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use App\Models\PlayerAnswer;

class QuestionGetterFactory
{
    public function __construct(
        private SmartQuestionGetter $smartQuestionGetter,
        private InitialQuestionGetter $initialQuestionGetter
    ) {
    }

    public function create(InputDto $input): QuestionGetter
    {
        $answeredQuestions = PlayerAnswer::where([
            'player_id' => $input->playerId
        ])->count();

        $totalInitialAttributes = count(InitialAttribute::cases()); // + count(SecondaryAttribute::cases());

        if ($answeredQuestions >= $totalInitialAttributes) {
            return $this->smartQuestionGetter;
        }

        return $this->initialQuestionGetter;
    }
}
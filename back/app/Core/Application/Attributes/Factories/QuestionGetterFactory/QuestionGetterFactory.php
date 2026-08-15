<?php

namespace App\Core\Application\Attributes\Factories\QuestionGetterFactory;

use App\Core\Application\Attributes\Services\GetQuestion\InitialQuestionGetter;
use App\Core\Application\Attributes\Services\GetQuestion\SmartQuestionGetter;
use App\Core\Application\Attributes\Services\GetQuestion\QuestionGetter;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Models\PlayerAnswer;
use App\Models\PlayerAttributeBlacklist;

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

        $skippedQuestions = PlayerAttributeBlacklist::where([
            'player_id' => $input->playerId
        ])->count();

        $totalInitialAttributes = count(InitialAttribute::cases());

        if (($answeredQuestions + $skippedQuestions) >= $totalInitialAttributes) {
            return $this->smartQuestionGetter;
        }

        return $this->initialQuestionGetter;
    }
}
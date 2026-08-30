<?php

namespace App\Core\Application\Attributes\Factories\QuestionGetterFactory;

use App\Core\Application\Attributes\Services\GetQuestion\InitialQuestionGetter;
use App\Core\Application\Attributes\Services\GetQuestion\SmartQuestionGetter;
use App\Core\Application\Attributes\Services\GetQuestion\CategoryQuestionGetter;
use App\Core\Application\Attributes\Services\GetQuestion\QuestionGetter;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Models\PlayerAnswer;
use App\Models\PlayerAttributeBlacklist;

class QuestionGetterFactory
{
    public function __construct(
        private SmartQuestionGetter $smartQuestionGetter,
        private InitialQuestionGetter $initialQuestionGetter,
        private CategoryQuestionGetter $categoryQuestionGetter
    ) {
    }

    public function create(InputDto $input): QuestionGetter
    {
        $answeredQuestions = PlayerAnswer::where([
            'player_id' => $input->playerId
        ])->get(['attribute_id', 'answer_score'])->toArray();
        $skippedQuestions = PlayerAttributeBlacklist::where([
            'player_id' => $input->playerId
        ])->count();
        $answeredQuestionsCount = count($answeredQuestions) + $skippedQuestions;

        $totalInitialAttributes = count(InitialAttribute::cases());

        if ($answeredQuestionsCount < $totalInitialAttributes) {
            return $this->initialQuestionGetter;
        }

        if ($answeredQuestionsCount == $totalInitialAttributes) {
            return $this->categoryQuestionGetter;
        }

        $randomNumber = rand(1, 3);
        // busca de subcategoria - tem randomNumber pro jogo não ficar tão mecânico e o usuário
        // ter a impressão que é só um filtro chato
        if ($answeredQuestionsCount == ($totalInitialAttributes + $randomNumber)) {
            return $this->categoryQuestionGetter;
        }

        return $this->smartQuestionGetter;
    }
}
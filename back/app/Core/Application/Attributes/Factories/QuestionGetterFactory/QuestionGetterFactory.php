<?php

namespace App\Core\Application\Attributes\Factories\QuestionGetterFactory;

use App\Core\Application\Attributes\Services\GetQuestion\InitialQuestionGetter;
use App\Core\Application\Attributes\Services\GetQuestion\SmartQuestionGetter;
use App\Core\Application\Attributes\Services\GetQuestion\CategoryQuestionGetter;
use App\Core\Application\Attributes\Services\GetQuestion\QuestionGetter;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Models\PlayerAnswer;
use App\Models\PlayerAttributeBlacklist;
use App\Core\Domain\Shared\Enums\CharacterCategory;

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

        $totalInitialAttributes = count(InitialAttribute::cases());

        if ((count($answeredQuestions) + $skippedQuestions) < $totalInitialAttributes) {
            return $this->initialQuestionGetter;
        }

        $positiveAttributes = array_map(function ($attribute) {
            if ($attribute['answer_score'] > 1) {
                return $attribute['attribute_id'];
            }
            return null;
        }, $answeredQuestions);

        if (!array_intersect($positiveAttributes, array_column(CharacterCategory::cases(), 'value'))) {
            return $this->categoryQuestionGetter;
        }

        return $this->smartQuestionGetter;
    }
}
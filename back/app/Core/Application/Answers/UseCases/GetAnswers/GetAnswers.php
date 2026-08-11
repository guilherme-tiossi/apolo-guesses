<?php

namespace App\Core\Application\Answers\UseCases\GetAnswers;

use App\Core\Domain\Answers\Entities\Answer;
use App\Core\Domain\Attributes\Entities\Attribute;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use App\Models\PlayerAnswer;

class GetAnswers
{    
    public function execute(InputDto $input): OutputDto
    {
        $bruteAnswers = PlayerAnswer::with('attribute')
            ->where('player_id', $input->playerId)
            ->get()
            ->toArray();

        $answers = array_map(function($answer) use ($input) {
            $bruteAttribute = $answer['attribute'];
            $attribute = new Attribute(
                    id: $bruteAttribute['id'],
                    question: $bruteAttribute['question'],
                    portugueseQuestion: $bruteAttribute['portuguese_question'],
                    enum: $bruteAttribute['is_initial_question']
                        ? InitialAttribute::tryFrom($bruteAttribute['internal_name'])
                        : ($bruteAttribute['is_secondary_question']
                            ? SecondaryAttribute::tryFrom($bruteAttribute['internal_name'])
                            : null)
                );

            return new Answer(
                playerId: $input->playerId,
                attribute: $attribute,
                value: $answer['answer_score']
            );
        }, $bruteAnswers);

        return new OutputDto(
            answers: $answers
        );
    }
}
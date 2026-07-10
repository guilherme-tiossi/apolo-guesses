<?php

namespace App\Core\Application\Answers\UseCases\GetAnswers;

use App\Core\Domain\Answers\Entities\Answer;
use App\Core\Domain\Attributes\Entities\Attribute;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use App\Models\TemporaryUserAnswer;

class GetAnswers
{    
    public function execute(InputDto $input): OutputDto
    {
        // usar algum repositório no futuro
        $bruteAnswers = TemporaryUserAnswer::with('attribute')
            ->where('temporary_user_id', $input->userId)
            ->get()
            ->toArray();

        $answers = array_map(function($answer) use ($input) {
            $bruteAttribute = $answer['attribute'];
            $attribute = new Attribute(
                    question: $bruteAttribute['question'],
                    portugueseQuestion: $bruteAttribute['portuguese_question'],
                    enum: $bruteAttribute['is_initial_question']
                        ? InitialAttribute::tryFrom($bruteAttribute['internal_name'])
                        : ($bruteAttribute['is_secondary_question']
                            ? SecondaryAttribute::tryFrom($bruteAttribute['internal_name'])
                            : null)
                );

            return new Answer(
                userId: $input->userId,
                attribute: $attribute,
                value: $answer['answer_score']
            );
        }, $bruteAnswers);

        return new OutputDto(
            answers: $answers
        );
    }
}
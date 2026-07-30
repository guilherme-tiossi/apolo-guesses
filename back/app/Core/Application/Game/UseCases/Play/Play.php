<?php

namespace App\Core\Application\Game\UseCases\Play;

use App\Core\Application\Answers\UseCases\PutAnswer\PutAnswer;
use App\Core\Application\Answers\UseCases\PutAnswer\InputDto as PutAnswerInputDto;
use App\Core\Application\Attributes\UseCases\GetQuestion\GetQuestion;
use App\Core\Application\Attributes\UseCases\GetQuestion\InputDto as QuestionGetterInputDto;
use Exception;

class Play
{
    public function __construct(
        private GetQuestion $questionGetter,
        private PutAnswer $answerSender
    ) {
    }

    public function execute(InputDto $input): OutputDto
    {
        if (!$input->playerId) {
            $questionOutput = $this->questionGetter->execute(new QuestionGetterInputDto());
            return new OutputDto(
                question: $questionOutput->question,
                attributeId: $questionOutput->attributeId,
                playerId: $questionOutput->playerId
            );
        }

        if (!isset($input->answerScore) || !isset($input->attributeId)) {
            throw new Exception("Dados inválidos para jogada!", 400);
        }

        $answerResult = $this->answerSender->execute(new PutAnswerInputDto(
            playerId: $input->playerId,
            attributeId: $input->attributeId,
            answerScore: $input->answerScore
        ));

        if ($answerResult) {
            return new OutputDto(
                characterName: $answerResult->characterName,
                playerId: $input->playerId
            );
        }

        $questionOutput = $this->questionGetter->execute(new QuestionGetterInputDto(
            playerId: $input->playerId
        ));

        return new OutputDto(
            question: $questionOutput->question,
            attributeId: $questionOutput->attributeId,
            playerId: $questionOutput->playerId
        );
    }
}
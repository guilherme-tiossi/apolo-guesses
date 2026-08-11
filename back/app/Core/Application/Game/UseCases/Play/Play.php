<?php

namespace App\Core\Application\Game\UseCases\Play;

use App\Core\Application\Answers\UseCases\PutAnswer\PutAnswer;
use App\Core\Application\Answers\UseCases\PutAnswer\InputDto as PutAnswerInputDto;
use App\Core\Application\Attributes\UseCases\GetQuestion\GetQuestion;
use App\Core\Application\Attributes\UseCases\GetQuestion\InputDto as QuestionGetterInputDto;
use App\Models\Character;
use App\Models\Attribute;
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

        // temporário... melhorar!
        $attribute = Attribute::find($input->attributeId);       
        if ($attribute->character_id) {
            if ($input->answerScore > 1) {
                $character = Character::find($answerResult->characterId);
                return new OutputDto(
                    characterName: $character->name,
                    playerId: $input->playerId
                );
            } else {
                throw new Exception("Personagem não encontrado!", 400);
            }
        }

        if ($answerResult) {
            $character = Character::find($answerResult->characterId);
            $attribute = Attribute::where('character_id', $character->id)->first();
            return new OutputDto(
                question: $attribute->portuguese_question,
                attributeId: $attribute->id,
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
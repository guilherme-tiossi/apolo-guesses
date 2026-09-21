<?php

namespace App\Core\Application\Answers\UseCases\UndoAnswer;

use App\Core\Application\Answers\UseCases\PutAnswer\PutAnswer;
use App\Models\Attribute;
use App\Models\PlayerAnswer;
use Exception;

class UndoAnswer
{
    public function __construct(
        private PutAnswer $putAnswer
    ) {
    }

    public function execute(InputDto $input): OutputDto
    {
        $answer = PlayerAnswer::where([
            'player_id' => $input->playerId,
            'attribute_id' => $input->attributeId,
        ])->first();

        if (!$answer) {
            throw new Exception('Não há resposta para desfazer.', 400);
        }

        $attribute = Attribute::findOrFail($input->attributeId);

        $this->putAnswer->revert($input->playerId, $input->attributeId);

        return new OutputDto(
            playerId: $input->playerId,
            attributeId: $input->attributeId,
            question: $attribute->portuguese_question
        );
    }
}

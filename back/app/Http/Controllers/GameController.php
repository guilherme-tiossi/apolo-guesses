<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Application\Answers\UseCases\UndoAnswer\InputDto as UndoAnswerInputDto;
use App\Core\Application\Answers\UseCases\UndoAnswer\UndoAnswer;
use App\Core\Application\Game\UseCases\Play\InputDto;
use App\Core\Application\Game\UseCases\Play\Play;

class GameController extends Controller
{
    public function __construct(
        private Play $play,
        private UndoAnswer $undoAnswer
    ) {
    }

    public function play(Request $request)
    {
        $result = $this->play->execute(new InputDto(
            playerId: $request->player_id,
            attributeId: $request->attribute_id,
            answerScore: $request->answer_score
        ));

        return response()->json(['data' => [
            'player' => $result->playerId,
            'question' => $result->question,
            'attribute_id' => $result->attributeId,
            'possible_character' => $result->characterName
        ]], 200);
    }

    public function back(Request $request)
    {
        $result = $this->undoAnswer->execute(new UndoAnswerInputDto(
            playerId: $request->player_id,
            attributeId: $request->attribute_id
        ));

        return response()->json(['data' => [
            'player' => $result->playerId,
            'question' => $result->question,
            'attribute_id' => $result->attributeId,
            'possible_character' => null,
        ]], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Application\Game\UseCases\Play\InputDto;
use App\Core\Application\Game\UseCases\Play\Play;

class GameController extends Controller
{
    public function __construct(
        private Play $play
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
}

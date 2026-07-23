<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Application\Answers\UseCases\PutAnswer\PutAnswer;
use App\Core\Application\Answers\UseCases\PutAnswer\InputDto as PutAnswerDto;

class AnswerController extends Controller
{
    public function __construct(
        private PutAnswer $putAnswer        
    ) {
    }

    public function answerQuestion(Request $request)
    {
        $response = $this->putAnswer->execute(new PutAnswerDto(
            temporaryUserId: $request->user_id,
            attributeId: $request->attribute_id,
            answerScore: $request->answer_score
        ));

        if ($response->characterName ?? false) {
            return response()->json([
                'possible_character' => $response->characterName
            ], 201);
        }

        return response()->json([], 201);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Application\Attributes\UseCases\GetQuestion\GetQuestion;
use App\Core\Application\Attributes\UseCases\GetQuestion\InputDto as QuestionDto;

class QuestionController extends Controller
{
    public function __construct(
        private GetQuestion $getQuestion        
    ) {
    }

    public function getQuestion(Request $request)
    {
        $result = $this->getQuestion->execute(new QuestionDto(
            temporaryUserId: $request->temporary_user_id
        ));

        return response()->json(['data' => [
            'temporary_user' => $result->temporaryUserId,
            'question' => $result->question,
            'attribute_id' => $result->attributeId
        ]], 200);
    }
}

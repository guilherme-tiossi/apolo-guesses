<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Application\Attributes\UseCases\GetInitialQuestion\GetInitialQuestion;
use App\Core\Application\Attributes\UseCases\GetInitialQuestion\InputDto as InitialQuestionDto;

class QuestionController extends Controller
{
    public function __construct(
        private GetInitialQuestion $getInitialQuestion        
    ) {
    }

    public function getFirstQuestion(Request $request)
    {
        $result = $this->getInitialQuestion->execute(new InitialQuestionDto(
            userId: $request->temporary_user_id
        ));

        return response()->json(['data' => [
            'temporary_user' => $result->temporaryUserId,
            'question' => $result->question,
            'attribute_id' => $result->attributeId
        ]], 200);
    }
}

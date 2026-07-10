<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

Route::get('/first-question', [QuestionController::class, 'getFirstQuestion']);
Route::post('/answer-question', [AnswerController::class, 'answerQuestion']);

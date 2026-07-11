<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

Route::get('/question', [QuestionController::class, 'getQuestion']);
Route::post('/answer-question', [AnswerController::class, 'answerQuestion']);

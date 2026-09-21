<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::post('/game', [GameController::class, 'play']);
Route::post('/game/back', [GameController::class, 'back']);

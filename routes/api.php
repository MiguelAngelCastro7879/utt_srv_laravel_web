<?php

use App\Http\Controllers\VerificationCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Games\CategoryController;
use App\Http\Controllers\Games\GamesController;
use App\Http\Controllers\Games\TokensController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/validate/aplication/code', [VerificationCodeController::class, 'validate_code_application']);

Route::resource('categories', CategoryController::class)->only(['index', 'store','update','destroy']);

Route::get('games', [GamesController::class, 'index'])->name('games');
Route::post('/new_game', [GamesController::class, 'store'])->name('new.game');
Route::put('game/{id}', [GamesController::class, 'update'])->name('update.game');
Route::delete('game/{id}', [GamesController::class, 'destroy'])->name('destroy.game');

//Routes Tokens
Route::get('/Tokens', [TokensController::class, 'index'])->name('Tokens');
Route::post('/Token', [TokensController::class, 'store'])->middleware('api')->name('new.token');
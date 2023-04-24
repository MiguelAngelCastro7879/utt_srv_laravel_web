<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\VerificationCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Games\CategoryController;
use App\Http\Controllers\Games\GamesController;
use App\Http\Controllers\GamesCodesController;
use App\Http\Controllers\QrCodeController;

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

Route::middleware('auth:sanctum')->post('/verify/qrcode', [QrCodeController::class, 'verify_qr'])->name('verify_qr'); // Esta ruta es la que valida el codigo web
// Route::post('/verify/qrcode', [QrCodeController::class, 'verify_qr'])->name('verify_qr'); // Esta ruta es la que valida el codigo web

Route::post('/validate/aplication/code', [VerificationCodeController::class, 'validate_code_application']);

Route::post('/login-app', [AuthenticatedSessionController::class, 'login_app']);

Route::get('/login-app-error', function(){
    return response()->json([
        'message' => 'Unauthorized'
    ], 401);
})->name('login-app-error');

Route::resource('categories', CategoryController::class)->only(['index', 'store','update','destroy']);
Route::resource('games', GamesController::class)->only(['index']);
Route::post('/update_game/{id}', [GamesController::class, 'update'])->name('update.game');
Route::post('/new_game', [GamesController::class, 'store'])->name('new.game');





//EDICION DE JUEGO
Route::get('enviar/codigo/actualizar/{id}', [GamesCodesController::class, 'send_update']);


//EDICION DE JUEGO
Route::get('enviar/codigo/eliminar/{id}', [GamesCodesController::class, 'send_destroy']);

<?php

use App\Events\QrScannerEvent;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\VerificationCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Games\CategoryController;
use App\Http\Controllers\Games\GamesController;
use App\Http\Controllers\GamesCodesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified', 'code_verified', 'qr_verified'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/catalogos', function () { return view('Dashboard/catalog'); })->name('catalogos');
    Route::get('/Videojuegos', [GamesController::class, 'index'])->name('Videojuegos');
    Route::get('/Nuevo', [GamesController::class, 'new'])->name('Nuevo');
    Route::get('/Actualizar/{id}', [GamesController::class, 'actualizar'])->middleware('game_code_verified')->name('Actualizar');
});

    // ->middleware(['auth', 'verified', 'code_verified'])

// Route::post('/Nuevo', [GamesController::class, 'new'])->name('Nuevo');

Route::middleware(['auth', 'code_verified', 'qr_verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CODIGOS DE VERIFICACION
Route::middleware(['auth'])->get('/verify_code', [VerificationCodeController::class, 'store'])->name('verify_code'); // Esta es la vista donde ingresas el codigo
Route::middleware(['auth'])->post('/validate/login/code', [VerificationCodeController::class, 'validate_code_login'])->name('last_code'); // Esta ruta es la que valida el codigo web

Route::get('/code', [VerificationCodeController::class, 'show'])->middleware('signed')->name('show_code'); // Esta es la vista que genera el mail

Route::middleware(['auth'])->get('/qrcode', [QrCodeController::class, 'show'])->name('qr_code'); // Esta ruta es la que muestra el qr en web
Route::get('/qrcode/verified', [QrCodeController::class, 'qr_verified'])->name('qr_verified'); // Esta ruta es la que valida el codigo web

Route::get('/show/image', [GamesController::class, 'showimage']);

// Route::get('verificar/codigo/juego', [GamesController::class, 'meter_codigo'])->name('CODIGO-JUEGO');











//GENERAR CODIGO DE EDICION
Route::get('codigo/actualizar/juego', [GamesController::class, 'meter_codigo_actualizar'])->name('CODIGO-JUEGO');
Route::get('/update/code', [GamesCodesController::class, 'show'])->middleware(['updatess'])->name('show_update_code'); // Esta es la vista que genera el mail
Route::get('/code/upd', [GamesCodesController::class, 'show_code'])->middleware('signed')->name('show_code_user'); // Esta es la vista que se le meustra al usuario
Route::post('/enviar/codigo/actualizar/juego', [GamesCodesController::class, 'token_update_sent'])->name('token_update_sent');








//GENERAR CODIGO DE ELIMINACION
Route::get('codigo/eliminar/juego', [GamesController::class, 'meter_codigo_eliminar'])->name('CODIGO-JUEGO');
Route::get('/destroy/code', [GamesCodesController::class, 'show_destroy'])->middleware(['destroyss'])->name('show_destroy_code'); // Esta es la vista que genera el mail
Route::get('/code/dest', [GamesCodesController::class, 'show_code_destroy'])->middleware('signed')->name('show_code_destroy_user'); // Esta es la vista que se le meustra al usuario
Route::post('/enviar/codigo/eliminar/juego', [GamesCodesController::class, 'token_destroy_sent'])->name('token_destroy_sent');







//Eliminacion de registros
Route::get('delete/games/{id}', [GamesController::class, 'destroy'])->middleware('delete_game_verified');




require __DIR__.'/auth.php';

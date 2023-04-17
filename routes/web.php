<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\VerificationCodeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Games\CategoryController;
use App\Http\Controllers\Games\GamesController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'code_verified'])->name('dashboard');

Route::get('/Videojuegos', [GamesController::class, 'index'])->middleware(['auth', 'verified', 'code_verified'])->name('Videojuegos');

Route::get('/Nuevo', [GamesController::class, 'new'])->middleware(['auth', 'verified', 'code_verified'])->name('Nuevo');
Route::get('/editar/{id}', [GamesController::class, 'editar'])->middleware(['auth', 'verified', 'code_verified'])->name('editar.registro');
Route::get('/Estatus', [GamesController::class, 'estatus'])->middleware(['auth', 'verified', 'code_verified'])->name('Estatus');
// Route::post('/Nuevo', [GamesController::class, 'new'])->name('Nuevo');

Route::middleware(['auth', 'code_verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CODIGOS DE VERIFICACION
Route::get('/verify_code', [VerificationCodeController::class, 'store'])->name('verify_code'); // Esta es la vista donde ingresas el codigo
Route::get('/code', [VerificationCodeController::class, 'show'])->middleware('signed')->name('show_code'); // Esta es la vista que genera el mail
Route::post('/validate/login/code', [VerificationCodeController::class, 'validate_code_login'])->name('last_code'); // Esta ruta es la que valida el codigo web

Route::get('/qrcode', [QrCodeController::class, 'show'])->name('qr_code'); // Esta ruta es la que valida el codigo web




require __DIR__.'/auth.php';

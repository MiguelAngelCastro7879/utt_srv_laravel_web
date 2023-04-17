<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/catalogos', function () {
    return view('Dashboard/catalog');
})->middleware(['auth', 'verified', 'code_verified'])->name('catalogos');

// CODIGOS DE VERIFICACION
Route::get('/verify_code', [VerificationCodeController::class, 'store'])->name('verify_code'); // Esta es la vista donde ingresas el codigo
Route::get('/code', [VerificationCodeController::class, 'show'])->middleware('signed')->name('show_code'); // Esta es la vista que genera el mail
Route::post('/validate/login/code', [VerificationCodeController::class, 'validate_code_login'])->name('last_code'); // Esta ruta es la que valida el codigo web

Route::get('/qrcode', [QrCodeController::class, 'show'])->name('qr_code'); // Esta ruta es la que valida el codigo web


require __DIR__.'/auth.php';

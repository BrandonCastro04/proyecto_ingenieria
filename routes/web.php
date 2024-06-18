<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::post('/pagos', [PagoController::class, 'store']);
Route::post('/viajes', [ViajeController::class, 'store']);

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
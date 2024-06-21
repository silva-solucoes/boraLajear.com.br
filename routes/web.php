<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('index');
});

Route::post('/paginas/forms', [FormController::class, 'submitForm'])->name('forms.submit');
// Rota para exibir a página de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rota para processar o login
Route::post('/login', [AuthController::class, 'login']);

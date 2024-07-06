<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Models\PageView;
use App\Http\Controllers\PerfilController;


Route::get('/', function () {
    // Incrementa a contagem de acessos
    $pageView = PageView::firstOrCreate(['page' => 'index']);
    $pageView->increment('views');

    return view('index');
});

Route::post('/paginas/forms', [FormController::class, 'submitForm'])->name('forms.submit');
// Rota para exibir a página de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rota para processar o login
Route::post('/login', [AuthController::class, 'login']);

Route::post('/admin/autenticar', [AuthController::class, 'authenticate'])->name('login.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::POST('/dashboard/backup', [DashboardController::class, 'performBackup'])->name('backup.perform');

Route::get('/gerar-csv', [DashboardController::class, 'gerarCsv'])->name('sugestao.csv');

// Rota para exibir a página de perfil do usuário
Route::get('/meu-perfil', [PerfilController::class, 'show'])->name('perfil.mostrar');

// Rota para processar a atualização do perfil do usuário
Route::post('/meu-perfil/atualizar', [PerfilController::class, 'update'])->name('perfil.atualizar');

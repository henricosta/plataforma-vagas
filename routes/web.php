<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VagaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\EmpresaController;
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

Route::get('/', [VagaController::class, 'index']);

Route::get('/vagas/busca', [VagaController::class, 'busca']);

Route::group([
    'prefix' => 'empresa',
    'middleware' => 'guest'
], function() {
    Route::get('login', [EmpresaController::class, 'showLogin'])->name('empresa.login');
    Route::post('login', [EmpresaController::class, 'login'])->name('empresa.login');
    Route::get('register', [EmpresaController::class, 'showRegister'])->name('empresa.register');
    Route::post('register', [EmpresaController::class, 'register'])->name('empresa.register');
    Route::post('logout', [EmpresaController::class, 'logout'])->name('empresa.logout');
});

Route::group([
    'prefix' => 'empresa',
    'middleware' => ['auth', 'empresa']
], function() {
    Route::get('profile', [EmpresaController::class, 'showProfile'])->name('empresa.profile');
    Route::get('profile/vaga', [EmpresaController::class, 'showVaga'])->name('empresa.vaga');
    Route::post('profile/vaga', [EmpresaController::class, 'createVaga'])->name('empresa.create.vaga');
    Route::put('profile/vaga', [EmpresaController::class, 'editVaga'])->name('empresa.edit.vaga');
});
// TODO: separar auths de user e empresa
// TODO: Criar rotas para o profile da empresa
// TODO: Criar rotas para adicionar vagas
Route::middleware('auth:web')->group(function () {
    Route::post('/profile/competencia', [ProfileController::class, 'addCompetencia'])->name('competencia.create');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

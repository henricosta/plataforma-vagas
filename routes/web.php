<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VagaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\Auth\PasswordController;
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
Route::get('cidades', [EmpresaController::class, 'getCidades'])->name('get.cidades');
Route::post('/candidatar', [ProfileController::class, 'candidatar'])->name('candidatar');

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
    'middleware' => ['auth:empresa']
], function() {
    Route::get('profile', [EmpresaController::class, 'showProfile'])->name('empresa.profile');
    Route::get('profile/vaga/{id}', [EmpresaController::class, 'showVaga'])->name('empresa.vaga');
    Route::put('profile/vaga/{id}', [EmpresaController::class, 'editVaga'])->name('empresa.vaga.edit');

    Route::get('profile/edit', [EmpresaController::class, 'edit'])->name('empresa.edit');
    Route::post('profile/edit', [EmpresaController::class, 'update'])->name('empresa.update');
    Route::delete('profile/edit', [EmpresaController::class, 'destroy'])->name('empresa.destroy');
    Route::post('password', [PasswordController::class, 'update'])->name('empresa.password.update');

    Route::get('create/vaga', [EmpresaController::class, 'createVagaForm'])->name('empresa.create.vaga.form');
    Route::post('create/vaga', [EmpresaController::class, 'createVaga'])->name('empresa.create.vaga');

    Route::post('logout', [EmpresaController::class, 'logout'])->name('empresa.logout');
});

Route::middleware('auth:web')->group(function () {
    Route::post('/profile/competencia', [ProfileController::class, 'addCompetencia'])->name('competencia.create');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

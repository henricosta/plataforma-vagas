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

Route::prefix('empresa')->group(function() {
    Route::get('login', [EmpresaController::class, 'showLogin']);
    Route::post('login', [EmpresaController::class, 'login'])->name('empresa.login');
    Route::get('register', [EmpresaController::class, 'showRegister']);
    Route::post('register', [EmpresaController::class, 'register'])->name('empresa.register');
    Route::post('logout', [EmpresaController::class, 'logout'])->name('empresa.logout');
});

Route::middleware('auth')->group(function () {
    Route::post('/profile/competencia', [ProfileController::class, 'addCompetencia'])->name('competencia.create');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

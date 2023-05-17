<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

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
    $vagas = \App\Models\Vaga::query()
        ->leftJoin('empresas', 'vagas.empresa_id', '=', 'empresas.id')
        ->select('vagas.*', 'empresas.nome as nome_empresa')
        ->take(15)
        ->get();
    return Inertia::render('Home', [
        'vagas' => $vagas
    ]);
});

Route::get('/vagas/busca', function(Request $request) {
    $titulo = $request->input('titulo');
    $vagas = \App\Models\Vaga::query()
        ->leftJoin('empresas', 'vagas.empresa_id', '=', 'empresas.id')
        ->select('vagas.*', 'empresas.nome as nome_empresa')
        ->where('vagas.titulo', 'like', "%{$titulo}%")
        ->take(10)
        ->get();
    return Inertia::render('Home', [
        'vagas' => $vagas,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use Inertia\Inertia;
use Illuminate\Http\Request;

class VagaController extends Controller
{
    public function busca(Request $request) {
        $busca = $request->input('busca');
        $modalidade = $request->input('modalidade');

        $vagas = Vaga::modalidade($modalidade)
            ->leftJoin('empresas', 'vagas.empresa_id', '=', 'empresas.id')
            ->select('vagas.*', 'empresas.nome as nome_empresa')
            ->where('vagas.titulo', 'like', "%{$busca}%")
            ->take(10)
            ->get();

        return Inertia::render('Home', [
            'vagas' => $vagas,
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vagas = Vaga::query()
            ->leftJoin('empresas', 'vagas.empresa_id', '=', 'empresas.id')
            ->selsect('vagas.*', 'empresas.nome as nome_empresa')
            ->take(15)
            ->get();
        return Inertia::render('Home', [
            'vagas' => $vagas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaga $vaga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaga $vaga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vaga $vaga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaga $vaga)
    {
        //
    }
}

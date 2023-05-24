<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;

class VagaController extends Controller
{
    public function __construct(protected Vaga $vagas) {}

    public function busca(Request $request) {
        $busca = $request->input('busca');
        $modalidade = $request->input('modalidade');

        $vagas = $this->vagas->busca($busca, $modalidade);

        return Inertia::render('Home', [
            'vagas' => $vagas,
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vagas = $this->vagas->listRecente();
        
        return Inertia::render('Home', [
            'vagas' => $vagas,
            'isLogged' => Auth::check()
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

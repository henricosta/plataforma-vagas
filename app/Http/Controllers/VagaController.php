<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;

class VagaController extends Controller
{
    public function __construct(protected Vaga $vagas) {}

    public function busca(Request $request) {
        $input = $request->only(['busca', 'modalidade', 'data', 'page', 'estado', 'cidade_id']);

        try {
            $vagas = $this->vagas->busca($input, $input['page']);

            return response()->json([
                'vagas' => $vagas->items(),
                'nextPageUrl' => $vagas->nextPageUrl(),
                'previousPageUrl' => $vagas->previousPageUrl(),
                'totalPages' => $vagas->lastPage(),
                'currentPage' => $vagas->currentPage()
            ]);
        } catch (\Exception $e) {
            return response()->json(['error_message' => 'Erro em busca: ' . $e->getMessage()]);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page');
        $vagas = $this->vagas->listRecente($page);
        $guard = 'guest';

        if (Auth::guard('web')->check()) $guard = 'web';
        if (Auth::guard('empresa')->check()) $guard = 'empresa';

        return Inertia::render('Home', [
            'guard' => $guard,
            'vagas' => $vagas->items(),
            'nextPageUrl' => $vagas->nextPageUrl(),
            'previousPageUrl' => $vagas->previousPageUrl(),
            'totalPages' => $vagas->lastPage(),
            'currentPage' => $vagas->currentPage(),
        ]);
    }

    public function getByEmpresa($empresaId) {
        $vagas = Vaga::with('cidade', 'empresa')->where('empresa_id', '=', $empresaId)->get();

        return json_encode($vagas);
    }

    public function getVaga($id) {
        $vaga = Vaga::with('empresa', 'cidade')->find($id);
        $guard = 'guest';
        if (Auth::guard('web')->check()) {
            $guard = 'web';
        } elseif (Auth::guard('empresa')->check()) {
            $guard = 'empresa';
        }

        return Inertia::render('Vaga', [
            'vaga' => $vaga,
            'guard' => $guard
        ]);
    }

    public function listEmpresaVagas() {
        $empresaId = Auth::user()->getAuthIdentifier();
        $vagas = Vaga::with('candidatos', 'cidade')->where('empresa_id', '=', $empresaId)->get();

        return Inertia::render('Empresa/ListEmpresaVagas', [
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
    public function edit($id)
    {
        $vaga = Vaga::with('cidade', 'candidatos')->find($id);

        if (Auth::user()->getAuthIdentifier() != $vaga['empresa_id']) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return Inertia::render('Empresa/EditVaga', [
            'vaga' => $vaga
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $id = $request->input('id');

        $vaga = Vaga::find($id);

        if (Auth::user()->getAuthIdentifier() != $vaga->empresa_id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:3000',
            'num_vagas' => 'required|numeric|min:1',
            'modalidade' => 'required|numeric|min:1|max:3',
            'cidade_id' => 'required|numeric',
        ]);

        $vaga->fill([
            'titulo' => $request->input('titulo'),
            'descricao' => $request->input('descricao'),
            'num_vagas' => $request->input('num_vagas'),
            'modalidade' => $request->input('modalidade'),
            'cidade_id' => $request->input('cidade_id')
        ]);

        $vaga->save();

        return Redirect::route('vaga.edit', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vaga = Vaga::find($id);
        if (Auth::user()->getAuthIdentifier() != $vaga->empresa_id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $vaga->delete();

        return Redirect::route('empresa.profile');
    }
}

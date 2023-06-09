<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;

class VagaController extends Controller
{
    public function __construct(protected Vaga $vagas) {}

    public function busca(Request $request) {   
        $input = $request->only(['busca', 'modalidade', 'data', 'page', 'estado']);
        
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
            return response()->json(['error_message' => $e->getMessage()]);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page');
        $vagas = $this->vagas->listRecente($page);
        $auth = 'guest';

        if (Auth::guard('web')->check()) $auth = 'web';
        if (Auth::guard('empresa')->check()) $auth = 'empresa';

        return Inertia::render('Home', [
            'auth' => $auth,
            'vagas' => $vagas->items(),
            'nextPageUrl' => $vagas->nextPageUrl(),
            'previousPageUrl' => $vagas->previousPageUrl(),
            'totalPages' => $vagas->lastPage(),
            'currentPage' => $vagas->currentPage(),
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

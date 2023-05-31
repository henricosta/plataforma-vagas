<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Empresa;
use App\Models\Vaga;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class EmpresaController extends Controller
{
    public function showLogin() {
        return Inertia::render('Auth/LoginEmpresa');
    }

    public function showRegister() {
        return Inertia::render('Auth/RegisterEmpresa');
    }

    public function login(Request $req) {
        $credentials = $req->only('email', 'password');
        if (Auth::guard('empresa')->attempt($credentials)) {
            $req->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            return redirect()->route('empresa.login')->withErrors([
                'email' => 'Credenciais inválidas'
            ]);
        }
    }

    public function register(Request $req) {
        $validatedData = $req->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:empresas',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $empresa = Empresa::create([
            'nome' => $validatedData['nome'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::guard('empresa')->login($empresa);

        return redirect()->intended('/');
    }

    public function logout(Request $req) {
        Auth::guard('empresa')->logout();

        $req->session()->invalidate();

        $req->session()->regenerateToken();

        return redirect('/');
    }

    public function showProfile() {
        $empresa = Empresa::with('vagas')->where('id', Auth::user()->getAuthIdentifier())->first();
        return Inertia::render('Profile/ProfileEmpresa', [
            'nome' => $empresa['nome'],
            'vagas' => $empresa['vagas']
        ]);
    }

    public function showVaga() {

    }
    public function createVagaForm() {
        return Inertia::render('Empresa/CreateVagaForm');
    }

    public function createVaga(Request $request) {
        Vaga::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'modalidade' => $request->modalidade,
            'cidade_id' => $request->cidade_id,
            'empresa_id' => Auth::user()->getAuthIdentifier(),
            'num_vagas' => $request->num_vagas
        ]);

        return Inertia::render('Empresa/CreateVagaForm', [
            'success' => true
        ]);
    }

    public function editVaga() {

    }

    public function getCidades(Request $request) {
        $sigla = $request->input('sigla');
        $cidades = Cidade::query()->where('uf', $sigla)->get();
        return response()->json($cidades);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Cidade;
use App\Models\Empresa;
use App\Models\Vaga;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class EmpresaController extends Controller
{
    public function showLogin() {
        return Inertia::render('Auth/Empresa/LoginEmpresa');
    }

    public function showRegister() {
        return Inertia::render('Auth/Empresa/RegisterEmpresa');
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
            'nome_titular' => 'required|string|max:255|unique:empresas',
            'nome_empresa' => 'required|string|max:255',
            'cnpj' => 'required|string|digits:14|unique:empresas',
            'cep' => 'required|string|digits:8',
            'email' => 'required|string|email|max:255',
            'telefone' => 'required|string|max:13',
            'num_funcionarios' => 'required|min:1',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $empresa = Empresa::create([
            'nome_titular' => $validatedData['nome_titular'],
            'nome_empresa' => $validatedData['nome_empresa'],
            'cnpj' => $validatedData['cnpj'],
            'cep' => $validatedData['cep'],
            'email' => $validatedData['email'],
            'telefone' => $validatedData['telefone'],
            'num_funcionarios' => $validatedData['num_funcionarios'],
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::guard('empresa')->login($empresa);

        return redirect()->intended(route('empresa.profile'));
    }

    public function logout(Request $req) {
        Auth::guard('empresa')->logout();

        $req->session()->invalidate();

        $req->session()->regenerateToken();

        return redirect('/');
    }

    public function showProfile() {
        $empresa = Empresa::with('vagas')->where('id', Auth::user()->getAuthIdentifier())->first();
        return Inertia::render('Profile/Empresa/ProfileEmpresa', [
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
        // TODO: Validar os dados
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
        return Inertia::render('Profile/EditEmpresa');
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $profileImage = $request->file('profile_image');
        $nome_empresa = $request->input('nome_empresa');
        $email = $request->input('email');
        $telefone = $request->input('telefone');
        $cnpj = $request->input('cnpj');
        $cep = $request->input('cep');

        if ($profileImage) {
            $path = Storage::put('public/profile_images', $profileImage);
            try {
                $request->user()->fill(['profile_image' => Storage::url($path)]);
            } catch (\Exception $e) {
                dd($e);
            }
        }

        if ($request->user()->email != $email) {
            $request->validate(['email' => 'required|string|unique:users,email|max:255']);
            $request->user()->fill(['email' => $email]);
        }

        if ($request->user()->cnpj != $cnpj) {
            $request->validate(['cnpj' => 'required|string|unique:users,cnpj|max:14']);
            $request->user()->fill(['cnpj' => $cnpj]);
        }

        if ($request->user()->telefone != $telefone && strlen($telefone) >= 10) {
            $request->validate(['telefone' => 'string|unique:users,telefone|max:11']);
            $request->user()->fill(['telefone' => $telefone]);
        }

        if ($request->user()->cep != $cep) {
            $request->validate(['cep' => 'required|string|max:8']);
            $request->user()->fill(['cep' => $cep]);
        }

        $request->validate(['nome_empresa' => 'required|string|min:3|max:255']);
        $request->user()->fill(['nome_empresa' => $nome_empresa]);

        $request->user()->save();

        return Redirect::route('empresa.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
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
        dd($req);
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

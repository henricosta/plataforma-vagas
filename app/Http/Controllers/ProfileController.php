<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Competencia;
use App\Models\Formacao;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function __construct(protected User $user){}

    public function show(Request $request): Response {
        $user = $request->user();

        $competencias = $user->competencias;
        $formacoes = $user->formacoes;

        $vagas = $user->vagas()->with('cidade', 'empresa')->get();

        return Inertia::render('Profile/User/ProfilePage', [
            'competencias' => $competencias,
            'vagas' => $vagas,
            'formacoes' => $formacoes
        ]);
    }

    public function addCompetencia(Request $request) {
        $competencia = $request->input('competencia');
        $userId = Auth::user()->id;
        $this->user->addCompetencia($competencia, $userId);

        return Redirect::route('profile.show');
    }

    public function addFormacao(Request $request) {
        Formacao::create([
            'user_id' => $request->user()->getAuthIdentifier(),
            'instituicao' => $request->input('instituicao'),
            'diploma' => $request->input('diploma'),
            'area' => $request->input('area'),
            'inicio' => $request->input('inicio'),
            'termino' => $request->input('termino'),
            'descricao' => $request->input('descricao'),
        ]);

        return Redirect::route('profile.show');
    }

    public function editFormacao(Request $request) {
        $formacao = Formacao::find($request->input('id'));

        try {
            $request->validate([
                'instituicao' => 'required|string|max:255',
                'diploma' => 'required|string|max:255',
                'area' => 'required|string|max:255',
                'inicio' => 'required|date',
                'termino' => 'date',
                'descricao' => 'required|string|max:255',
            ]);
        } catch(\Exception $e) {
            dd($e);
        }

        try {
            $formacao->fill([
                'instituicao' => $request->input('instituicao'),
                'diploma' => $request->input('diploma'),
                'area' => $request->input('area'),
                'inicio' => $request->input('inicio'),
                'termino' => $request->input('termino') || '',
                'descricao' => $request->input('descricao'),
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $formacao->save();

        return Redirect::route('profile.show');
    }

    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/User/EditUser', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $nome_completo = $request->input('nome_completo');
        $email = $request->input('email');
        $telefone = $request->input('telefone');
        $profileImage = $request->file('profile_image');

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

        if ($request->user()->telefone != $telefone && strlen($telefone) >= 10) {
            $request->validate(['telefone' => 'string|unique:users,telefone|max:11']);
            $request->user()->fill(['telefone' => $telefone]);
        }

        $request->validate(['nome_completo' => 'required|string|min:3|max:255']);
        $request->user()->fill(['nome_completo' => $nome_completo]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
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

    public function candidatar(Request $request) {
        if (!Auth::guard('web')->check()) {
            return response()->json([
                'redirect' => true
            ]);
        }

        $vagaId = $request->input('vaga_id');
        $action = $request->input('action');

        if ($action == 'create') {
            if (!Auth::user()->vagas()->wherePivot('vaga_id', $vagaId)->exists()) {
                Auth::user()->vagas()->attach($vagaId);
            }

            return response()->json([
                'success' => true,
                'message' => $action
            ]);
        } elseif ($action == 'remove') {
            Auth::user()->vagas()->detach($vagaId);

            return response()->json([
                'success' => true
            ]);
        }
    }

    public function getUser($id) {
        $user = $this->user->getUserWithCompetencias($id);

        return Inertia::render('User', [
            'user' => $user
        ]);
    }

    function deleteCompetencia(Request $request) {
        $user = User::find($request->user()->getAuthIdentifier());
        $user->competencias()->detach($request->input('id'));

        Redirect::route('profile.show');
    }

    function deleteFormacao(Request $request) {
        $f = Formacao::find($request->input('id'));
        if($f) {
            $f->delete();
        }

        Redirect::route('profile.show');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Competencia;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function __construct(protected User $user){}

    public function show(Request $request): Response {
        $user = $this->user->getUserWithCompetencias(Auth::user()->id);
        return Inertia::render('Profile/ProfilePage', [
            'status' => session('status'),
            'id' => $user['id'],
            'nome_completo' => $user['nome_completo'],
            'email' => $user['email'],
            'telefone' => $user['telefone'],
            'competencias' => $user['competencias']
        ]);
    }

    public function addCompetencia(Request $request) {
        $competencia = $request->input('competencia');
        $userId = Auth::user()->id;
        $this->user->addCompetencia($competencia, $userId);
        return Inertia::render('Profile/ProfilePage', [
            'status' => session('status'),
            'user' => Auth::user()
        ]);
    }

    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

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
}

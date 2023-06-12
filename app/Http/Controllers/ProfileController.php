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
        $vagas = $user->vagas()->with('cidade', 'empresa')->get();

        return Inertia::render('Profile/User/ProfilePage', [
            'competencias' => $competencias,
            'vagas' => $vagas
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
}

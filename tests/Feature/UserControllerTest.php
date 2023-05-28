<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RegisteredUserControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testRegister()
    {
        Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

        $nomeCompleto = $this->faker->name;
        $email = $this->faker->unique()->safeEmail;
        $password = 'password123';

        $requestData = [
            'nome_completo' => $nomeCompleto,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ];

        $response = $this->post(route('register'), $requestData);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'nome_completo' => $nomeCompleto,
            'email' => $email,
        ]);

        $user = User::where('email', $email)->first();

        $this->assertTrue(Hash::check($password, $user->password));

        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id, Auth::id());
    }
}

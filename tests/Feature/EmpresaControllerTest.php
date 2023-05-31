<?php

use App\Http\Controllers\EmpresaController;
use App\Models\Empresa;
use App\Models\Vaga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EmpresaControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testRegister()
    {
        $nome = $this->faker->name;
        $email = $this->faker->unique()->safeEmail;
        $password = 'password123';

        $requestData = [
            'nome' => $nome,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ];

        $response = $this->post(route('empresa.register'), $requestData);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('empresas', [
            'nome' => $nome,
            'email' => $email,
        ]);

        $empresa = Empresa::where('email', $email)->first();

        $this->assertTrue(Hash::check($password, $empresa->password));

        $this->assertTrue(Auth::guard('empresa')->check());
        $this->assertEquals($empresa->id, Auth::guard('empresa')->id());
    }

    public function testLogin()
    {
        $password = 'password123';
        $empresa = Empresa::factory()->create([
            'password' => Hash::make($password),
        ]);

        $requestData = [
            'email' => $empresa->email,
            'password' => $password,
        ];

        $response = $this->post(route('empresa.login'), $requestData);

        $response->assertRedirect('/');
        $this->assertTrue(Auth::guard('empresa')->check());
        $this->assertEquals($empresa->id, Auth::guard('empresa')->id());
    }
}

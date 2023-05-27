<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmpresaControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_create_empresa(): void
    {
        $data = [
            'nome' => 'Empresa Teste',
            'password' => 'password'
        ];

        $response = $this->post('/empresa/register', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('empresas', [
            'nome' => 'Empresa Teste'
        ]);
    }
}

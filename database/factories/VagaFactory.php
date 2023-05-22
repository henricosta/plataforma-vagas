<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vaga>
 */
class VagaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $num_empresas = Empresa::all()->count();

        return [
            'titulo' => fake()->text(255),
            'descricao' => fake()->text(3000),
            'num_vagas' => fake()->numberBetween(1, 50),
            'empresa_id' => fake()->numberBetween(1, $num_empresas),
            'cidade_id' => fake()->numberBetween(1, 5570),
            'modalidade' => strval(fake()->numberBetween(1, 3))
        ];
    }
}

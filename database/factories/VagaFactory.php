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
        return [
            'titulo' => fake()->text(255),
            'descricao' => fake()->text(3000),
            'num_vagas' => fake()->numberBetween(1, 50),
            'empresa_id' => Empresa::factory()->create()->getKey()
        ];
    }
}

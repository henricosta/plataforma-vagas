<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->unique()->company(),
            'email' => fake()->unique()->companyEmail(),
            'telefone' => fake()->unique()->phoneNumber(),
            'cnpj' => fake()->unique()->regexify('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/'), // 14 Digitos de 0-9
            'cep' => fake()->numerify('########'), // 8 Dígitos de 0-9
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}

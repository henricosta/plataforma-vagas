<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\User;
use App\Models\Vaga;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(50)
            ->create();

        Empresa::factory()
            ->count(50)
            ->create();

        Vaga::factory()
            ->count(100)
            ->create();
    }
}

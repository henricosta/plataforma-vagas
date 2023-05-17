<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\User;
use App\Models\Vaga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $path = storage_path() . "\\json\\cidades.json";
        $cidades = json_decode(file_get_contents($path), true);

        foreach ($cidades['data'] as $cidade) {
            DB::table('cidades')->insert([
                'id' => $cidade['Id'],
                'codigo' => $cidade['Codigo'],
                'nome' => $cidade['Nome'],
                'uf' => $cidade['Uf']
            ]);
        }

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

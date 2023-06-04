<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}

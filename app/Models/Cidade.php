<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cidades';

    public function vagas() {
        return $this->hasMany(Vaga::class, 'cidade_id');
    }

    public function getCidades($uf) {
        $cidades = Cidade::query()->where('uf', $uf)->get();
        return response()->json($cidades);
    }
}

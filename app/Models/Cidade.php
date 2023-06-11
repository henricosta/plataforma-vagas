<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cidades';

    public function vagas() {
        return $this->hasMany(Vaga::class, 'cidade_id');
    }
}

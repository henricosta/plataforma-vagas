<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Empresa extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function createEmpresa($nome, $password) {
        $empresa = Empresa::create([
            'nome' => $nome,
            'password' => $password
        ]);

        return $empresa;
    }

    public function vagas(): HasMany {
        return $this->hasMany(Vaga::class);
    }
}

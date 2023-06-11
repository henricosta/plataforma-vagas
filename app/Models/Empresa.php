<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Empresa extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nome_titular',
        'nome_empresa',
        'email',
        'cnpj',
        'cep',
        'telefone',
        'password',
        'profile_image',
        'descricao'
    ];
    protected $hidden = ['password', 'remember_token'];

    public function vagas(): HasMany {
        return $this->hasMany(Vaga::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vaga extends Model
{
    use HasFactory;

    public function empresa(): BelongsTo {
        return $this->belongsTo(Empresa::class);
    }

    public function busca($busca, $modalidade) {
        $vagas = $this->modalidade($modalidade)
            ->leftJoin('empresas', 'vagas.empresa_id', '=', 'empresas.id')
            ->select('vagas.*', 'empresas.nome as nome_empresa')
            ->where('vagas.titulo', 'like', "%{$busca}%")
            ->take(10)
            ->get();
        
        return $vagas;
    }

    public function listRecente() {
        $vagas = $this->query()
            ->leftJoin('empresas', 'vagas.empresa_id', '=', 'empresas.id')
            ->select('vagas.*', 'empresas.nome as nome_empresa')
            ->take(15)
            ->get();
        
        return $vagas;
    }

    public function scopeModalidade(Builder $query, $modalidade) {
        if($modalidade > 0) {
            return $query->where('modalidade', '=', $modalidade);
        }
        return $query;
    }
}

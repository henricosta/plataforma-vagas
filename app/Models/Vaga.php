<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'modalidade',
        'empresa_id',
        'num_vagas',
        'cidade_id'
    ];

    public function empresa(): BelongsTo {
        return $this->belongsTo(Empresa::class);
    }

    public function busca($busca, $modalidade) {
        $vagas = Vaga::modalidade($modalidade)
            ->with('empresa')
            ->join('cidades', 'cidades.id', 'vagas.cidade_id')
            ->select('vagas.*', 'cidades.nome as nome_cidade')
            ->where('vagas.titulo', 'like', "%{$busca}%")
            ->take(10)
            ->get();

        return $vagas;
    }

    // TODO: Adicionar paginação
    public function listRecente($page = 15) {
        $vagas = Vaga::with('empresa')
            ->latest('created_at')
            ->join('cidades', 'cidades.id', 'vagas.cidade_id')
            ->select('vagas.*', 'cidades.nome as nome_cidade')
            ->paginate(15);

        dd($vagas);

        return $vagas;
    }

    public function scopeModalidade(Builder $query, $modalidade) {
        if($modalidade > 0) {
            return $query->where('modalidade', '=', $modalidade);
        }
        return $query;
    }
}

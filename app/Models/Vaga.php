<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function candidaturas() {
        return $this->belongsToMany(Candidatura::class);
    }

    public function busca($input, $page=1): LengthAwarePaginator {
        $busca = $input['busca'];
        $modalidade = $input['modalidade'];
        $data = $input['data'];
        $estado = $input['estado'];
        $cidadeId = $input['cidade_id'];

        $vagas = Vaga::modalidade($modalidade)
            ->data($data)
            ->titulo($busca)
            ->with('empresa')
            ->select('vagas.*')
            ->paginate(perPage: 10, page: $page);

        return $vagas;
    }

    public function listRecente($page=1): LengthAwarePaginator {
        $vagas = Vaga::with('empresa')
            ->latest('created_at')
            ->join('cidades', 'cidades.id', 'vagas.cidade_id')
            ->select('vagas.*', 'cidades.nome as nome_cidade')
            ->paginate(perPage: 10, page: $page);

        return $vagas;
    }

    public function scopeTitulo($query, $busca) {
        if (strlen($busca) > 1) {
            return $query->where('vagas.titulo', 'like', "%{$busca}%");
        }

        return $query;
    }

    public function scopeModalidade(Builder $query, $modalidade) {
        if($modalidade > 0 && $modalidade <= 4) {
            return $query->where('modalidade', '=', $modalidade);
        }
        return $query;
    }


    public function scopeData($query, $value) {
        switch ($value) {
            case 1:
                $date = now()->subDay();
                break;
            case 2:
                $date = now()->subWeek();
                break;
            case 3:
                $date = now()->subMonth();
                break;
            case 4:
                $date = now()->subMonths(3);
                break;
            case 0:
                return $query;
        }

        return $query->where('created_at', '>=', $date);
    }

    public function scopeEstadoCidade(Builder $query, $estado, $cidade_id) {
        if ($cidade_id > 0) {
            return $query->join('cidades', 'cidades.id', '=','vagas.cidade_id')
            ->where('cidades.id', '=', $cidade_id);
        } elseif (strlen($estado) == 2) {
            return $query->join('cidades', 'cidades.id', '=','vagas.cidade_id')
            ->where('cidades.uf', '=', $estado);
        }

        return $query->join('cidades', 'cidades.id', 'vagas.cidade_id');
    }


    public function candidatos() {
        return $this->belongsToMany(User::class, 'candidaturas');
    }

    public function cidade() {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }
}

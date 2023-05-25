<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'competencia'
    ];

    public static function insertCompetencia(String $competencia) {
        return Competencia::firstOrCreate([
            'competencia' => strtolower($competencia)
        ]);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_competencia', 'competencia_id', 'user_id');
    }
}

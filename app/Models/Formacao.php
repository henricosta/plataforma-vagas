<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formacao extends Model
{
    use HasFactory;

    protected $table = 'formacao';
    protected $fillable = ['user_id', 'instituicao', 'diploma', 'area', 'inicio', 'termino', 'descricao'];
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
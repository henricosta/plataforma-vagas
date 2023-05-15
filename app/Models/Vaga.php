<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vaga extends Model
{
    use HasFactory;

    public function empresa(): BelongsTo {
        return $this->belongsTo(Empresa::class);
    }
}

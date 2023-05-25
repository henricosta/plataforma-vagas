<?php
// TODO: Desacoplar user das competências
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome_completo',
        'email',
        'password',
        'telefone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addCompetencia(String $competencia, $userId) {
        $comp = Competencia::firstOrCreate([
            'competencia' => strtolower($competencia)
        ]);

        $this->attachUniqueCompetencias($comp->id, $userId);
    }

    public function attachUniqueCompetencias($competencia_id, $user_id) {
        $attachedIds = $this->competencias()->whereIn('competencias.id', [
            'competencia_id' => $competencia_id,
            'user_id' => $user_id
        ])->pluck('competencias.id');

        $this->competencias()->attach($attachedIds->diff([$competencia_id, $user_id]));
    }

    public function competencias() {
        return $this->belongsToMany(Competencia::class, 'user_competencia', 'user_id', 'competencia_id');
    }
}

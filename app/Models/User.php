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
        'telefone',
        'profile_image'
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

    public function getUserWithCompetencias($userId) {
        $user = User::with('competencias:competencia')->find($userId);
        return $user;
    }

    public function addCompetencia(String $competencia, $userId) {
        $comp = Competencia::firstOrCreate([
            'competencia' => strtolower($competencia)
        ]);

        $this->attachUniqueCompetencias($comp->id, $userId);
    }

    private function attachUniqueCompetencias($competencia_id, $user_id) {
        $user = User::find($user_id);
        // TODO: syncWithoutDetaching() é muito lenta
        $user->competencias()->syncWithoutDetaching([$competencia_id]);
    }

    public function competencias() {
        return $this->belongsToMany(Competencia::class, 'user_competencia', 'user_id', 'competencia_id');
    }

    public function vagas() {
        return $this->belongsToMany(Vaga::class, 'candidaturas');
    }
}

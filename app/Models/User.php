<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'users';
    protected $fillable = [
        'vc_nome',
        'email',
        'password',
        'dt_data_registro',
        'it_id_tipo_user'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tipoUser()
    {
        return $this->belongsTo(TipoUser::class, 'it_id_tipo_user');
    }
    public function workplaces()
    {
        return $this->hasMany(Workplace::class, 'it_id_user_criador');
    }
    public function quadros()
    {
        return $this->hasMany(Quadro::class, 'it_id_user_criador');
    }
    public function cartaos()
    {
        return $this->hasMany(Cartao::class, 'it_id_user_criador');
    }
    public function anexos()
    {
        return $this->hasMany(Anexo::class, 'it_id_user_upload');
    }
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'it_id_user_autor');
    }
    public function membroQuadros()
    {
        return $this->hasMany(MembroQuadro::class, 'it_id_user');
    }
    public function chatMensagens()
    {
        return $this->hasMany(ChatMensagem::class, 'it_id_user_autor');
    }
    public function chatAnexos()
    {
        return $this->hasMany(ChatAnexo::class, 'it_id_user_upload');
    }
    public function membroCartaos()
    {
        return $this->hasMany(MembroCartao::class, 'it_id_user');
    }
    public function membroWorkplaces()
    {
        return $this->hasMany(MembroWorkplace::class, 'it_id_user');
    }
    public function membroQuadroConvitesConvidado()
    {
        return $this->hasMany(MembroQuadroConvite::class, 'it_id_user_convidado');
    }
    public function membroQuadroConvitesConvidador()
    {
        return $this->hasMany(MembroQuadroConvite::class, 'it_id_user_convidador');
    }
    public function membroWorkplaceConvitesConvidado()
    {
        return $this->hasMany(MembroWorkplaceConvite::class, 'it_id_user_convidado');
    }
    public function membroWorkplaceConvitesConvidador()
    {
        return $this->hasMany(MembroWorkplaceConvite::class, 'it_id_user_convidador');
    }
}

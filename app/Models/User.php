<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'vc_nome',
        'email',
        'password',
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

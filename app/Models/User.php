<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'vc_nome',
        'email',
        'password',
        'it_id_tipo_user'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function tipo_user()
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

    public function membro_quadros()
    {
        return $this->hasMany(MembroQuadro::class, 'it_id_user');
    }

    public function chat_mensagens()
    {
        return $this->hasMany(ChatMensagem::class, 'it_id_user_autor');
    }

    public function chat_anexos()
    {
        return $this->hasMany(ChatAnexo::class, 'it_id_user_upload');
    }

    public function membro_cartaos()
    {
        return $this->hasMany(MembroCartao::class, 'it_id_user');
    }

    public function membro_workplaces()
    {
        return $this->hasMany(MembroWorkplace::class, 'it_id_user');
    }

    public function membro_quadro_convites_convidado()
    {
        return $this->hasMany(MembroQuadroConvite::class, 'it_id_user_convidado');
    }

    public function membro_quadro_convites_convidador()
    {
        return $this->hasMany(MembroQuadroConvite::class, 'it_id_user_convidador');
    }

    public function membro_workplace_convites_convidado()
    {
        return $this->hasMany(MembroWorkplaceConvite::class, 'it_id_user_convidado');
    }

    public function membro_workplace_convites_convidador()
    {
        return $this->hasMany(MembroWorkplaceConvite::class, 'it_id_user_convidador');
    }
}
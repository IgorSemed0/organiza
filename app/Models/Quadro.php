<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quadro extends Model
{
    use SoftDeletes;

    protected $table = 'quadros';

    protected $fillable = ['it_id_workplace', 'it_id_user_criador', 'vc_nome', 'vc_descricao'];

    public function workplace()
    {
        return $this->belongsTo(Workplace::class, 'it_id_workplace');
    }

    public function user_criador()
    {
        return $this->belongsTo(User::class, 'it_id_user_criador');
    }

    public function listas()
    {
        return $this->hasMany(Lista::class, 'it_id_quadro');
    }

    public function etiquetas()
    {
        return $this->hasMany(Etiqueta::class, 'it_id_quadro');
    }

    public function chat_mensagens()
    {
        return $this->hasMany(ChatMensagem::class, 'it_id_quadro');
    }

    public function membros()
    {
        return $this->hasMany(MembroQuadro::class, 'it_id_quadro');
    }

    public function convites()
    {
        return $this->hasMany(MembroQuadroConvite::class, 'it_id_quadro');
    }
}
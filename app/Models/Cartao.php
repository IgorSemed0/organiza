<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Cartao extends Model
{
    protected $table = 'cartaos';
    protected $fillable = ['it_id_lista', 'it_id_user_criador', 'vc_titulo', 'vc_descricao', 'dt_data_criacao', 'dt_data_vencimento', 'it_ordem'];
    public function lista()
    {
        return $this->belongsTo(Lista::class, 'it_id_lista');
    }
    public function userCriador()
    {
        return $this->belongsTo(User::class, 'it_id_user_criador');
    }
    public function anexos()
    {
        return $this->hasMany(Anexo::class, 'it_id_cartao');
    }
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'it_id_cartao');
    }
    public function cartaoEtiquetas()
    {
        return $this->hasMany(CartaoEtiqueta::class, 'it_id_cartao');
    }
    public function membroCartaos()
    {
        return $this->hasMany(MembroCartao::class, 'it_id_cartao');
    }
    public function listasVerificacaos()
    {
        return $this->hasMany(ListaVerificacao::class, 'it_id_cartao');
    }
}


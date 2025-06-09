<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Comentario extends Model
{
    protected $table = 'comentarios';
    protected $fillable = ['it_id_cartao', 'it_id_user_autor', 'vc_texto', 'dt_data_criacao'];
    public function cartao()
    {
        return $this->belongsTo(Cartao::class, 'it_id_cartao');
    }
    public function userAutor()
    {
        return $this->belongsTo(User::class, 'it_id_user_autor');
    }
}


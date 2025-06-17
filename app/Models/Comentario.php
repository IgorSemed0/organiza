<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comentario extends Model
{
    use SoftDeletes;

    protected $table = 'comentarios';

    protected $fillable = ['it_id_cartao', 'it_id_user_autor', 'vc_texto'];

    public function cartao() { return $this->belongsTo(Cartao::class, 'it_id_cartao'); }
    public function userAutor() { return $this->belongsTo(User::class, 'it_id_user_autor'); }
}

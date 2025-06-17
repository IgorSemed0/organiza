<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatMensagem extends Model
{
    use SoftDeletes;

    protected $table = 'chat_mensagems';

    protected $fillable = ['it_id_quadro', 'it_id_user_autor', 'vc_texto_mensagem'];

    public function quadro() { return $this->belongsTo(Quadro::class, 'it_id_quadro'); }
    public function userAutor() { return $this->belongsTo(User::class, 'it_id_user_autor'); }
    public function anexos() { return $this->hasMany(ChatAnexo::class, 'it_id_chat_mensagem'); }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ChatMensagem extends Model
{
    protected $table = 'chat_mensagems';
    protected $fillable = ['it_id_quadro', 'it_id_user_autor', 'vc_texto_mensagem', 'dt_data_envio'];
    public function quadro()
    {
        return $this->belongsTo(Quadro::class, 'it_id_quadro');
    }
    public function userAutor()
    {
        return $this->belongsTo(User::class, 'it_id_user_autor');
    }
    public function chatAnexos()
    {
        return $this->hasMany(ChatAnexo::class, 'it_id_chat_mensagem');
    }
}


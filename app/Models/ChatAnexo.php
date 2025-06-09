<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ChatAnexo extends Model
{
    protected $table = 'chat_anexos';
    protected $fillable = ['it_id_chat_mensagem', 'it_id_user_upload', 'vc_nome_arquivo', 'vc_caminho_arquivo', 'dt_data_upload'];
    public function chatMensagem()
    {
        return $this->belongsTo(ChatMensagem::class, 'it_id_chat_mensagem');
    }
    public function userUpload()
    {
        return $this->belongsTo(User::class, 'it_id_user_upload');
    }
}


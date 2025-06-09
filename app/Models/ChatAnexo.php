<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatAnexo extends Model
{
    use SoftDeletes;

    protected $table = 'chat_anexos';

    protected $fillable = ['it_id_chat_mensagem', 'it_id_user_upload', 'vc_nome_arquivo', 'vc_caminho_arquivo'];

    public function chatMensagem() { return $this->belongsTo(ChatMensagem::class, 'it_id_chat_mensagem'); }
                 public function userUpload() { return $this->belongsTo(User::class, 'it_id_user_upload'); }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Anexo extends Model
{
    protected $table = 'anexos';
    protected $fillable = ['it_id_cartao', 'it_id_user_upload', 'vc_nome_arquivo', 'vc_caminho_arquivo', 'dt_data_upload'];
    public function cartao()
    {
        return $this->belongsTo(Cartao::class, 'it_id_cartao');
    }
    public function userUpload()
    {
        return $this->belongsTo(User::class, 'it_id_user_upload');
    }
}


<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MembroQuadroConvite extends Model
{
    protected $table = 'membro_quadro_convites';
    protected $fillable = ['it_id_quadro', 'it_id_user_convidado', 'it_id_user_convidador', 'vc_status', 'dt_data_envio', 'dt_data_expiracao'];
    public function quadro()
    {
        return $this->belongsTo(Quadro::class, 'it_id_quadro');
    }
    public function userConvidado()
    {
        return $this->belongsTo(User::class, 'it_id_user_convidado');
    }
    public function userConvidador()
    {
        return $this->belongsTo(User::class, 'it_id_user_convidador');
    }
}


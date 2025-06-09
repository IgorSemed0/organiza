<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MembroWorkplaceConvite extends Model
{
    protected $table = 'membro_workplace_convites';
    protected $fillable = ['it_id_workplace', 'it_id_user_convidado', 'it_id_user_convidador', 'vc_status', 'dt_data_envio', 'dt_data_expiracao'];
    public function workplace()
    {
        return $this->belongsTo(Workplace::class, 'it_id_workplace');
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


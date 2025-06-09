<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembroWorkplaceConvite extends Model
{
    use SoftDeletes;

    protected $table = 'membro_workplace_convites';

    protected $fillable = ['it_id_workplace', 'it_id_user_convidado', 'it_id_user_convidador', 'vc_status'];

    public function workplace() { return $this->belongsTo(Workplace::class, 'it_id_workplace'); }
    public function userConvidado() { return $this->belongsTo(User::class, 'it_id_user_convidado'); }
    public function userConvidador() { return $this->belongsTo(User::class, 'it_id_user_convidador'); }
}

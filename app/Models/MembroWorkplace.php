<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MembroWorkplace extends Model
{
    protected $table = 'membro_workplaces';
    protected $fillable = ['it_id_workplace', 'it_id_user', 'vc_funcao'];
    public function workplace()
    {
        return $this->belongsTo(Workplace::class, 'it_id_workplace');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'it_id_user');
    }
}


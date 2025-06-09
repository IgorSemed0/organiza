<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MembroQuadro extends Model
{
    protected $table = 'membro_quadros';
    protected $fillable = ['it_id_quadro', 'it_id_user', 'vc_funcao'];
    public function quadro()
    {
        return $this->belongsTo(Quadro::class, 'it_id_quadro');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'it_id_user');
    }
}


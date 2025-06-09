<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembroQuadro extends Model
{
    use SoftDeletes;

    protected $table = 'membro_quadros';

    protected $fillable = ['it_id_quadro', 'it_id_user', 'vc_funcao'];

    public function quadro() { return $this->belongsTo(Quadro::class, 'it_id_quadro'); }
    public function user() { return $this->belongsTo(User::class, 'it_id_user'); }
}

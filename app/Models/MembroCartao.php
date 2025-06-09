<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembroCartao extends Model
{
    use SoftDeletes;

    protected $table = 'membro_cartaos';

    protected $fillable = ['it_id_cartao', 'it_id_user'];

    public function cartao() { return $this->belongsTo(Cartao::class, 'it_id_cartao'); }
                    public function user() { return $this->belongsTo(User::class, 'it_id_user'); }
}

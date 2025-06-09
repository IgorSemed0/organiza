<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MembroCartao extends Model
{
    protected $table = 'membro_cartaos';
    protected $fillable = ['it_id_cartao', 'it_id_user'];
    public function cartao()
    {
        return $this->belongsTo(Cartao::class, 'it_id_cartao');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'it_id_user');
    }
}


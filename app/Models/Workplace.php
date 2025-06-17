<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workplace extends Model
{
    use SoftDeletes;

    protected $table = 'workplaces';

    protected $fillable = ['vc_nome', 'vc_descricao', 'it_id_user_criador'];

    public function user_criador()
    {
        return $this->belongsTo(User::class, 'it_id_user_criador');
    }

    public function quadros()
    {
        return $this->hasMany(Quadro::class, 'it_id_workplace');
    }

    public function membros()
    {
        return $this->hasMany(MembroWorkplace::class, 'it_id_workplace');
    }

    public function convites()
    {
        return $this->hasMany(MembroWorkplaceConvite::class, 'it_id_workplace');
    }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Workplace extends Model
{
    protected $table = 'workplaces';
    protected $fillable = ['vc_nome', 'vc_descricao', 'dt_data_criacao', 'it_id_user_criador'];
    public function userCriador()
    {
        return $this->belongsTo(User::class, 'it_id_user_criador');
    }
    public function quadros()
    {
        return $this->hasMany(Quadro::class, 'it_id_workplace');
    }
    public function membroWorkplaces()
    {
        return $this->hasMany(MembroWorkplace::class, 'it_id_workplace');
    }
    public function membroWorkplaceConvites()
    {
        return $this->hasMany(MembroWorkplaceConvite::class, 'it_id_workplace');
    }
}


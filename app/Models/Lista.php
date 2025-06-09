<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Lista extends Model
{
    protected $table = 'listas';
    protected $fillable = ['it_id_quadro', 'vc_nome', 'it_ordem'];
    public function quadro()
    {
        return $this->belongsTo(Quadro::class, 'it_id_quadro');
    }
    public function cartaos()
    {
        return $this->hasMany(Cartao::class, 'it_id_lista');
    }
}


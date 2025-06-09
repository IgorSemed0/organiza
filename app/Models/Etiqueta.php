<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Etiqueta extends Model
{
    protected $table = 'etiquetas';
    protected $fillable = ['it_id_quadro', 'vc_nome', 'vc_cor'];
    public function quadro()
    {
        return $this->belongsTo(Quadro::class, 'it_id_quadro');
    }
    public function cartaoEtiquetas()
    {
        return $this->hasMany(CartaoEtiqueta::class, 'it_id_etiqueta');
    }
}


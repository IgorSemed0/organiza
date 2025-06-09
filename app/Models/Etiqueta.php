<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etiqueta extends Model
{
    use SoftDeletes;

    protected $table = 'etiquetas';

    protected $fillable = ['it_id_quadro', 'vc_nome', 'vc_cor'];

    public function quadro() { return $this->belongsTo(Quadro::class, 'it_id_quadro'); }
                public function cartaos() { return $this->belongsToMany(Cartao::class, 'cartao_etiquetas', 'it_id_etiqueta', 'it_id_cartao'); }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartaoEtiqueta extends Model
{
    use SoftDeletes;

    protected $table = 'cartao_etiquetas';

    protected $fillable = ['it_id_cartao', 'it_id_etiqueta'];

    public function cartao() { return $this->belongsTo(Cartao::class, 'it_id_cartao'); }
    public function etiqueta() { return $this->belongsTo(Etiqueta::class, 'it_id_etiqueta'); }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CartaoEtiqueta extends Model
{
    protected $table = 'cartao_etiquetas';
    protected $fillable = ['it_id_cartao', 'it_id_etiqueta'];
    public function cartao()
    {
        return $this->belongsTo(Cartao::class, 'it_id_cartao');
    }
    public function etiqueta()
    {
        return $this->belongsTo(Etiqueta::class, 'it_id_etiqueta');
    }
}


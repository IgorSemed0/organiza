<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemListaVerificacao extends Model
{
    use SoftDeletes;

    protected $table = 'itens_lista_verificacaos';

    protected $fillable = ['it_id_lista_verificacao', 'vc_texto', 'bt_completo'];

    public function listaVerificacao() { return $this->belongsTo(ListaVerificacao::class, 'it_id_lista_verificacao'); }
}

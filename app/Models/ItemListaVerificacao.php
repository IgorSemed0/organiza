<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ItemListaVerificacao extends Model
{
    protected $table = 'itens_lista_verificacaos';
    protected $fillable = ['it_id_lista_verificacao', 'vc_texto', 'bt_completo'];
    public function listaVerificacao()
    {
        return $this->belongsTo(ListaVerificacao::class, 'it_id_lista_verificacao');
    }
}


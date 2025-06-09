<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListaVerificacao extends Model
{
    use SoftDeletes;

    protected $table = 'listas_verificacaos';

    protected $fillable = ['it_id_cartao', 'vc_nome'];

    public function cartao() { return $this->belongsTo(Cartao::class, 'it_id_cartao'); }
                        public function itens() { return $this->hasMany(ItemListaVerificacao::class, 'it_id_lista_verificacao'); }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ItemListaVerificacao;

class ItemListaVerificacaoSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_lista_verificacao' => 1, 'vc_texto' => 'Escolher cores', 'bt_completo' => true],
    ['it_id_lista_verificacao' => 2, 'vc_texto' => 'Confirmar participantes', 'bt_completo' => false],
    ['it_id_lista_verificacao' => 3, 'vc_texto' => 'Aprovar texto', 'bt_completo' => true],
    ['it_id_lista_verificacao' => 4, 'vc_texto' => 'Testar funcionalidade', 'bt_completo' => false],
    ['it_id_lista_verificacao' => 5, 'vc_texto' => 'Contactar fornecedor', 'bt_completo' => true],
    ['it_id_lista_verificacao' => 6, 'vc_texto' => 'Verificar tipografia', 'bt_completo' => false]
  ];

        foreach ($data as $item) {
            ItemListaVerificacao::create($item);
        }
    }
}

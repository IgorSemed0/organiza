<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ListaVerificacao;

class ListaVerificacaoSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_cartao' => 1, 'vc_nome' => 'Design do esquema da DB'],
    ['it_id_cartao' => 2, 'vc_nome' => 'Reunião'],
    ['it_id_cartao' => 3, 'vc_nome' => 'Revisão do esquema da BD'],
    ['it_id_cartao' => 4, 'vc_nome' => 'Resolução de bugs'],
    ['it_id_cartao' => 5, 'vc_nome' => 'Revisão da correçã de gugs'],
    ['it_id_cartao' => 6, 'vc_nome' => 'Revisão final']
  ];

        foreach ($data as $item) {
            ListaVerificacao::create($item);
        }
    }
}

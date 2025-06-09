<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Lista;

class ListaSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_quadro' => 1, 'vc_nome' => 'A Fazer', 'it_ordem' => 1],
    ['it_id_quadro' => 1, 'vc_nome' => 'Em Progresso', 'it_ordem' => 2],
    ['it_id_quadro' => 2, 'vc_nome' => 'Ideias', 'it_ordem' => 1],
    ['it_id_quadro' => 3, 'vc_nome' => 'Backlog', 'it_ordem' => 1],
    ['it_id_quadro' => 4, 'vc_nome' => 'Pendentes', 'it_ordem' => 1],
    ['it_id_quadro' => 5, 'vc_nome' => 'Concluídos', 'it_ordem' => 1]
  ];

        foreach ($data as $item) {
            Lista::create($item);
        }
    }
}

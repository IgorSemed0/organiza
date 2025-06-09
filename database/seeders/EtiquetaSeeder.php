<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Etiqueta;

class EtiquetaSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_quadro' => 1, 'vc_nome' => 'Urgente', 'vc_cor' => '#FF0000'],
    ['it_id_quadro' => 2, 'vc_nome' => 'Social Media', 'vc_cor' => '#00FF00'],
    ['it_id_quadro' => 3, 'vc_nome' => 'Prioridade Alta', 'vc_cor' => '#FF4500'],
    ['it_id_quadro' => 4, 'vc_nome' => 'Baixa Prioridade', 'vc_cor' => '#87CEEB'],
    ['it_id_quadro' => 5, 'vc_nome' => 'Logística', 'vc_cor' => '#FFD700'],
    ['it_id_quadro' => 6, 'vc_nome' => 'Design', 'vc_cor' => '#800080']
  ];

        foreach ($data as $item) {
            Etiqueta::create($item);
        }
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\MembroQuadro;

class MembroQuadroSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_quadro' => 1, 'it_id_user' => 1, 'vc_funcao' => 'Administrador'],
    ['it_id_quadro' => 1, 'it_id_user' => 2, 'vc_funcao' => 'Editor'],
    ['it_id_quadro' => 2, 'it_id_user' => 3, 'vc_funcao' => 'Membro'],
    ['it_id_quadro' => 3, 'it_id_user' => 4, 'vc_funcao' => 'Gestor'],
    ['it_id_quadro' => 4, 'it_id_user' => 5, 'vc_funcao' => 'Editor'],
    ['it_id_quadro' => 5, 'it_id_user' => 6, 'vc_funcao' => 'Administrador']
  ];

        foreach ($data as $item) {
            MembroQuadro::create($item);
        }
    }
}

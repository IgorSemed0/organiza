<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Workplace;

class WorkplaceSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['vc_nome' => 'Equipa Marketing', 'vc_descricao' => 'Espaço para campanhas de marketing', 'it_id_user_criador' => 1],
    ['vc_nome' => 'Projecto TI', 'vc_descricao' => 'Gestão de desenvolvimento de software', 'it_id_user_criador' => 2],
    ['vc_nome' => 'Plano Académico', 'vc_descricao' => 'Organização de tarefas escolares', 'it_id_user_criador' => 3],
    ['vc_nome' => 'Evento Corporativo', 'vc_descricao' => 'Planeamento de eventos', 'it_id_user_criador' => 4],
    ['vc_nome' => 'Design Gráfico', 'vc_descricao' => 'Projetos de design e branding', 'it_id_user_criador' => 5],
    ['vc_nome' => 'Gestão Financeira', 'vc_descricao' => 'Controlo de orçamentos', 'it_id_user_criador' => 6]
  ];

        foreach ($data as $item) {
            Workplace::create($item);
        }
    }
}

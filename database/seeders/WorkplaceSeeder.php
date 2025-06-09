<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Workplace;

class WorkplaceSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['vc_nome' => 'Equipa Marketing', 'vc_descricao' => 'Espaço para campanhas de marketing', 'dt_data_criacao' => '2025-01-10 09:00:00', 'it_id_user_criador' => 1],
    ['vc_nome' => 'Projecto TI', 'vc_descricao' => 'Gestão de desenvolvimento de software', 'dt_data_criacao' => '2025-01-11 14:00:00', 'it_id_user_criador' => 2],
    ['vc_nome' => 'Plano Académico', 'vc_descricao' => 'Organização de tarefas escolares', 'dt_data_criacao' => '2025-01-12 10:30:00', 'it_id_user_criador' => 3],
    ['vc_nome' => 'Evento Corporativo', 'vc_descricao' => 'Planeamento de eventos', 'dt_data_criacao' => '2025-01-13 15:15:00', 'it_id_user_criador' => 4],
    ['vc_nome' => 'Design Gráfico', 'vc_descricao' => 'Projetos de design e branding', 'dt_data_criacao' => '2025-01-14 11:45:00', 'it_id_user_criador' => 5],
    ['vc_nome' => 'Gestão Financeira', 'vc_descricao' => 'Controlo de orçamentos', 'dt_data_criacao' => '2025-01-15 13:20:00', 'it_id_user_criador' => 6]
  ];

        foreach ($data as $item) {
            Workplace::create($item);
        }
    }
}

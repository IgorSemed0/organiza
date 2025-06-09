<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Quadro;

class QuadroSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_workplace' => 1, 'it_id_user_criador' => 1, 'vc_nome' => 'Campanha Janeiro', 'vc_descricao' => 'Planeamento da campanha de início de ano', 'dt_data_criacao' => '2025-01-16 08:00:00', 'vc_visibilidade' => 'privado'],
    ['it_id_workplace' => 1, 'it_id_user_criador' => 2, 'vc_nome' => 'Redes Sociais', 'vc_descricao' => 'Gestão de posts e conteúdos', 'dt_data_criacao' => '2025-01-17 12:00:00', 'vc_visibilidade' => 'público'],
    ['it_id_workplace' => 2, 'it_id_user_criador' => 3, 'vc_nome' => 'Desenvolvimento App', 'vc_descricao' => 'Tarefas do novo aplicativo', 'dt_data_criacao' => '2025-01-18 09:30:00', 'vc_visibilidade' => 'privado'],
    ['it_id_workplace' => 3, 'it_id_user_criador' => 4, 'vc_nome' => 'Trabalhos Escolares', 'vc_descricao' => 'Organização de entregas', 'dt_data_criacao' => '2025-01-19 14:45:00', 'vc_visibilidade' => 'público'],
    ['it_id_workplace' => 4, 'it_id_user_criador' => 5, 'vc_nome' => 'Evento Anual', 'vc_descricao' => 'Planeamento logístico', 'dt_data_criacao' => '2025-01-20 10:15:00', 'vc_visibilidade' => 'privado'],
    ['it_id_workplace' => 5, 'it_id_user_criador' => 6, 'vc_nome' => 'Logotipo Novo', 'vc_descricao' => 'Criação de identidade visual', 'dt_data_criacao' => '2025-01-21 16:00:00', 'vc_visibilidade' => 'público']
  ];

        foreach ($data as $item) {
            Quadro::create($item);
        }
    }
}

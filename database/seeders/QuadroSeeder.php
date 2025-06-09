<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Quadro;

class QuadroSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_workplace' => 1, 'it_id_user_criador' => 1, 'vc_nome' => 'Campanha Janeiro', 'vc_descricao' => 'Planeamento da campanha de início de ano', 'vc_visibilidade' => 'privado'],
    ['it_id_workplace' => 1, 'it_id_user_criador' => 2, 'vc_nome' => 'Redes Sociais', 'vc_descricao' => 'Gestão de posts e conteúdos', 'vc_visibilidade' => 'público'],
    ['it_id_workplace' => 2, 'it_id_user_criador' => 3, 'vc_nome' => 'Desenvolvimento App', 'vc_descricao' => 'Tarefas do novo aplicativo', 'vc_visibilidade' => 'privado'],
    ['it_id_workplace' => 3, 'it_id_user_criador' => 4, 'vc_nome' => 'Trabalhos Escolares', 'vc_descricao' => 'Organização de entregas', 'vc_visibilidade' => 'público'],
    ['it_id_workplace' => 4, 'it_id_user_criador' => 5, 'vc_nome' => 'Evento Anual', 'vc_descricao' => 'Planeamento logístico', 'vc_visibilidade' => 'privado'],
    ['it_id_workplace' => 5, 'it_id_user_criador' => 6, 'vc_nome' => 'Logotipo Novo', 'vc_descricao' => 'Criação de identidade visual', 'vc_visibilidade' => 'público']
  ];

        foreach ($data as $item) {
            Quadro::create($item);
        }
    }
}

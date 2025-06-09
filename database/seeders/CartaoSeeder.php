<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Cartao;

class CartaoSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_lista' => 1, 'it_id_user_criador' => 1, 'vc_titulo' => 'Criar Banner', 'vc_descricao' => 'Banner para campanha de Janeiro', 'dt_data_vencimento' => '2025-01-30', 'it_ordem' => 1],
    ['it_id_lista' => 2, 'it_id_user_criador' => 2, 'vc_titulo' => 'Reunião Equipa', 'vc_descricao' => 'Discutir progresso', 'dt_data_vencimento' => '2025-01-25', 'it_ordem' => 1],
    ['it_id_lista' => 3, 'it_id_user_criador' => 3, 'vc_titulo' => 'Post Instagram', 'vc_descricao' => 'Publicar teaser da campanha', 'dt_data_vencimento' => null, 'it_ordem' => 1],
    ['it_id_lista' => 4, 'it_id_user_criador' => 4, 'vc_titulo' => 'Corrigir Bugs', 'vc_descricao' => 'Resolver erros no app', 'dt_data_vencimento' => '2025-02-01', 'it_ordem' => 1],
    ['it_id_lista' => 5, 'it_id_user_criador' => 5, 'vc_titulo' => 'Planeamento Catering', 'vc_descricao' => 'Definir menu do evento', 'dt_data_vencimento' => '2025-02-05', 'it_ordem' => 1],
    ['it_id_lista' => 6, 'it_id_user_criador' => 6, 'vc_titulo' => 'Aprovar Design', 'vc_descricao' => 'Revisão final do logotipo', 'dt_data_vencimento' => '2025-01-31', 'it_ordem' => 1]
  ];

        foreach ($data as $item) {
            Cartao::create($item);
        }
    }
}

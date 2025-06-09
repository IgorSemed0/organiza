<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Comentario;

class ComentarioSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_cartao' => 1, 'it_id_user_autor' => 2, 'vc_texto' => 'O banner precisa de mais contraste.', 'dt_data_criacao' => '2025-01-29 09:00:00'],
    ['it_id_cartao' => 2, 'it_id_user_autor' => 3, 'vc_texto' => 'Confirmada para as 14h.', 'dt_data_criacao' => '2025-01-29 14:00:00'],
    ['it_id_cartao' => 3, 'it_id_user_autor' => 4, 'vc_texto' => 'A imagem está pronta?', 'dt_data_criacao' => '2025-01-29 10:30:00'],
    ['it_id_cartao' => 4, 'it_id_user_autor' => 5, 'vc_texto' => 'Corrigi dois bugs hoje.', 'dt_data_criacao' => '2025-01-29 15:00:00'],
    ['it_id_cartao' => 5, 'it_id_user_autor' => 6, 'vc_texto' => 'Sugiro adicionar sobremesa.', 'dt_data_criacao' => '2025-01-29 11:15:00'],
    ['it_id_cartao' => 6, 'it_id_user_autor' => 1, 'vc_texto' => 'Aprovado com ajustes menores.', 'dt_data_criacao' => '2025-01-29 13:20:00']
  ];

        foreach ($data as $item) {
            Comentario::create($item);
        }
    }
}

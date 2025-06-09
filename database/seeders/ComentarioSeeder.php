<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Comentario;

class ComentarioSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_cartao' => 1, 'it_id_user_autor' => 2, 'vc_texto' => 'O banner precisa de mais contraste.'],
    ['it_id_cartao' => 2, 'it_id_user_autor' => 3, 'vc_texto' => 'Confirmada para as 14h.'],
    ['it_id_cartao' => 3, 'it_id_user_autor' => 4, 'vc_texto' => 'A imagem está pronta?'],
    ['it_id_cartao' => 4, 'it_id_user_autor' => 5, 'vc_texto' => 'Corrigi dois bugs hoje.'],
    ['it_id_cartao' => 5, 'it_id_user_autor' => 6, 'vc_texto' => 'Sugiro adicionar sobremesa.'],
    ['it_id_cartao' => 6, 'it_id_user_autor' => 1, 'vc_texto' => 'Aprovado com ajustes menores.']
  ];

        foreach ($data as $item) {
            Comentario::create($item);
        }
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\CartaoEtiqueta;

class CartaoEtiquetaSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_cartao' => 1, 'it_id_etiqueta' => 1],
    ['it_id_cartao' => 2, 'it_id_etiqueta' => 2],
    ['it_id_cartao' => 3, 'it_id_etiqueta' => 3],
    ['it_id_cartao' => 4, 'it_id_etiqueta' => 4],
    ['it_id_cartao' => 5, 'it_id_etiqueta' => 5],
    ['it_id_cartao' => 6, 'it_id_etiqueta' => 6]
  ];

        foreach ($data as $item) {
            CartaoEtiqueta::create($item);
        }
    }
}

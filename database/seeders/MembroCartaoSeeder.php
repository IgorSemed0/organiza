<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\MembroCartao;

class MembroCartaoSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_cartao' => 1, 'it_id_user' => 2],
    ['it_id_cartao' => 2, 'it_id_user' => 3],
    ['it_id_cartao' => 3, 'it_id_user' => 4],
    ['it_id_cartao' => 4, 'it_id_user' => 5],
    ['it_id_cartao' => 5, 'it_id_user' => 6],
    ['it_id_cartao' => 6, 'it_id_user' => 1]
  ];

        foreach ($data as $item) {
            MembroCartao::create($item);
        }
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\MembroWorkplaceConvite;

class MembroWorkplaceConviteSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_workplace' => 1, 'it_id_user_convidado' => 3, 'it_id_user_convidador' => 1, 'vc_status' => 'aceite'],
    ['it_id_workplace' => 2, 'it_id_user_convidado' => 4, 'it_id_user_convidador' => 2, 'vc_status' => 'pendente'],
    ['it_id_workplace' => 3, 'it_id_user_convidado' => 5, 'it_id_user_convidador' => 3, 'vc_status' => 'recusado'],
    ['it_id_workplace' => 4, 'it_id_user_convidado' => 6, 'it_id_user_convidador' => 4, 'vc_status' => 'aceite'],
    ['it_id_workplace' => 5, 'it_id_user_convidado' => 1, 'it_id_user_convidador' => 5, 'vc_status' => 'pendente'],
    ['it_id_workplace' => 6, 'it_id_user_convidado' => 2, 'it_id_user_convidador' => 6, 'vc_status' => 'aceite']
  ];

        foreach ($data as $item) {
            MembroWorkplaceConvite::create($item);
        }
    }
}

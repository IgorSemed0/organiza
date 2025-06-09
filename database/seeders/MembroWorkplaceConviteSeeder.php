<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\MembroWorkplaceConvite;

class MembroWorkplaceConviteSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_workplace' => 1, 'it_id_user_convidado' => 3, 'it_id_user_convidador' => 1, 'vc_status' => 'aceite', 'dt_data_envio' => '2025-02-02 09:00:00', 'dt_data_expiracao' => '2025-02-09 09:00:00'],
    ['it_id_workplace' => 2, 'it_id_user_convidado' => 4, 'it_id_user_convidador' => 2, 'vc_status' => 'pendente', 'dt_data_envio' => '2025-02-02 12:00:00', 'dt_data_expiracao' => '2025-02-09 12:00:00'],
    ['it_id_workplace' => 3, 'it_id_user_convidado' => 5, 'it_id_user_convidador' => 3, 'vc_status' => 'recusado', 'dt_data_envio' => '2025-02-02 10:30:00', 'dt_data_expiracao' => '2025-02-09 10:30:00'],
    ['it_id_workplace' => 4, 'it_id_user_convidado' => 6, 'it_id_user_convidador' => 4, 'vc_status' => 'aceite', 'dt_data_envio' => '2025-02-02 15:00:00', 'dt_data_expiracao' => '2025-02-09 15:00:00'],
    ['it_id_workplace' => 5, 'it_id_user_convidado' => 1, 'it_id_user_convidador' => 5, 'vc_status' => 'pendente', 'dt_data_envio' => '2025-02-02 11:00:00', 'dt_data_expiracao' => '2025-02-09 11:00:00'],
    ['it_id_workplace' => 6, 'it_id_user_convidado' => 2, 'it_id_user_convidador' => 6, 'vc_status' => 'aceite', 'dt_data_envio' => '2025-02-02 13:00:00', 'dt_data_expiracao' => '2025-02-09 13:00:00']
  ];

        foreach ($data as $item) {
            MembroWorkplaceConvite::create($item);
        }
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['vc_nome' => 'Administrador', 'vc_email' => 'admin@email.com', 'vc_senha' => '12345678', 'dt_data_registro' => '2025-01-01 10:00:00', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Silvia Clara', 'vc_email' => 'clara@email.com', 'vc_senha' => 'senha123', 'dt_data_registro' => '2025-01-01 10:00:00', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Januário dos Santos', 'vc_email' => 'bruno.costa@email.com', 'vc_senha' => 'abc123', 'dt_data_registro' => '2025-01-02 14:30:00', 'it_id_tipo_user' => 2],
    ['vc_nome' => 'Dário Budjurra', 'vc_email' => 'budjurra@email.com', 'vc_senha' => 'xyz123', 'dt_data_registro' => '2025-01-03 09:15:00', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Isidro de Oliveira', 'vc_email' => 'isidro@email.com', 'vc_senha' => 'pass2025', 'dt_data_registro' => '2025-01-04 16:45:00', 'it_id_tipo_user' => 2],
    ['vc_nome' => 'Eva Pereira', 'vc_email' => 'eva@email.com', 'vc_senha' => 'eva321', 'dt_data_registro' => '2025-01-05 11:20:00', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Horácio Manuel', 'vc_email' => 'horacio@email.com', 'vc_senha' => '12345678', 'dt_data_registro' => '2025-01-06 13:10:00', 'it_id_tipo_user' => 2]
  ];

        foreach ($data as $item) {
            $item['vc_senha'] = Hash::make($item['vc_senha']);
            User::create($item);
        }
    }
}

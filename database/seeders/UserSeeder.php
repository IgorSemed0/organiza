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
    ['vc_nome' => 'Administrador', 'email' => 'admin@email.com', 'password' => '12345678', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Silvia Clara', 'email' => 'clara@email.com', 'password' => 'senha123', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Januário dos Santos', 'email' => 'bruno.costa@email.com', 'password' => 'abc123', 'it_id_tipo_user' => 2],
    ['vc_nome' => 'Dário Budjurra', 'email' => 'budjurra@email.com', 'password' => 'xyz123', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Isidro de Oliveira', 'email' => 'isidro@email.com', 'password' => 'pass2025', 'it_id_tipo_user' => 2],
    ['vc_nome' => 'Eva Pereira', 'email' => 'eva@email.com', 'password' => 'eva321', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Horácio Manuel', 'email' => 'horacio@email.com', 'password' => '12345678', 'it_id_tipo_user' => 2]
  ];

        foreach ($data as $item) {
            $item['password'] = Hash::make($item['password']);
            User::create($item);
        }
    }
}

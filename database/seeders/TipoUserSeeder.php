<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\TipoUser;

class TipoUserSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['vc_nome' => 'Administrador', 'vc_descricao' => 'Utilizador com permissões completas'],
    ['vc_nome' => 'User', 'vc_descricao' => 'Utilizador com permissões básicas']
  ];

        foreach ($data as $item) {
            TipoUser::create($item);
        }
    }
}

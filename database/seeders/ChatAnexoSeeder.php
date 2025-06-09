<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ChatAnexo;

class ChatAnexoSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_chat_mensagem' => 1, 'it_id_user_upload' => 1, 'vc_nome_arquivo' => 'plano.jpg', 'vc_caminho_arquivo' => '/uploads/plano.jpg'],
    ['it_id_chat_mensagem' => 2, 'it_id_user_upload' => 2, 'vc_nome_arquivo' => 'posts.csv', 'vc_caminho_arquivo' => '/uploads/posts.xlsx'],
    ['it_id_chat_mensagem' => 3, 'it_id_user_upload' => 3, 'vc_nome_arquivo' => 'descriao?projecto.pdf', 'vc_caminho_arquivo' => '/uploads/agenda_chat.pdf'],
    ['it_id_chat_mensagem' => 4, 'it_id_user_upload' => 4, 'vc_nome_arquivo' => 'print_do_bug.png', 'vc_caminho_arquivo' => '/uploads/screenshot.png'],
    ['it_id_chat_mensagem' => 5, 'it_id_user_upload' => 5, 'vc_nome_arquivo' => 'nota.txt', 'vc_caminho_arquivo' => '/uploads/nota.txt'],
    ['it_id_chat_mensagem' => 6, 'it_id_user_upload' => 6, 'vc_nome_arquivo' => 'logo_final.png', 'vc_caminho_arquivo' => '/uploads/logo_final.png']
  ];

        foreach ($data as $item) {
            ChatAnexo::create($item);
        }
    }
}

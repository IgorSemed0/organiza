<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ChatAnexo;

class ChatAnexoSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_chat_mensagem' => 1, 'it_id_user_upload' => 1, 'vc_nome_arquivo' => 'plano.jpg', 'vc_caminho_arquivo' => '/uploads/plano.jpg', 'dt_data_upload' => '2025-01-30 09:05:00'],
    ['it_id_chat_mensagem' => 2, 'it_id_user_upload' => 2, 'vc_nome_arquivo' => 'posts.csv', 'vc_caminho_arquivo' => '/uploads/posts.xlsx', 'dt_data_upload' => '2025-01-30 12:05:00'],
    ['it_id_chat_mensagem' => 3, 'it_id_user_upload' => 3, 'vc_nome_arquivo' => 'descriao?projecto.pdf', 'vc_caminho_arquivo' => '/uploads/agenda_chat.pdf', 'dt_data_upload' => '2025-01-30 10:35:00'],
    ['it_id_chat_mensagem' => 4, 'it_id_user_upload' => 4, 'vc_nome_arquivo' => 'print_do_bug.png', 'vc_caminho_arquivo' => '/uploads/screenshot.png', 'dt_data_upload' => '2025-01-30 15:05:00'],
    ['it_id_chat_mensagem' => 5, 'it_id_user_upload' => 5, 'vc_nome_arquivo' => 'nota.txt', 'vc_caminho_arquivo' => '/uploads/nota.txt', 'dt_data_upload' => '2025-01-30 11:05:00'],
    ['it_id_chat_mensagem' => 6, 'it_id_user_upload' => 6, 'vc_nome_arquivo' => 'logo_final.png', 'vc_caminho_arquivo' => '/uploads/logo_final.png', 'dt_data_upload' => '2025-01-30 13:05:00']
  ];

        foreach ($data as $item) {
            ChatAnexo::create($item);
        }
    }
}

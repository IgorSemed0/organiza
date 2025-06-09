<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ChatMensagem;

class ChatMensagemSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_quadro' => 1, 'it_id_user_autor' => 1, 'vc_texto_mensagem' => 'Equipa, precisamos acelerar.', 'dt_data_envio' => '2025-01-30 09:00:00'],
    ['it_id_quadro' => 2, 'it_id_user_autor' => 2, 'vc_texto_mensagem' => 'Alguém viu o plano?', 'dt_data_envio' => '2025-01-30 12:00:00'],
    ['it_id_quadro' => 3, 'it_id_user_autor' => 3, 'vc_texto_mensagem' => 'Reunião amanhã às 12h:30min.', 'dt_data_envio' => '2025-01-30 10:30:00'],
    ['it_id_quadro' => 4, 'it_id_user_autor' => 4, 'vc_texto_mensagem' => 'Progresso está fixe!', 'dt_data_envio' => '2025-01-30 15:00:00'],
    ['it_id_quadro' => 5, 'it_id_user_autor' => 5, 'vc_texto_mensagem' => 'Confio no vosso trabalho, acho kkk.', 'dt_data_envio' => '2025-01-30 11:00:00'],
    ['it_id_quadro' => 6, 'it_id_user_autor' => 6, 'vc_texto_mensagem' => 'Design finalizado hoje?', 'dt_data_envio' => '2025-01-30 13:00:00']
  ];

        foreach ($data as $item) {
            ChatMensagem::create($item);
        }
    }
}

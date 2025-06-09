<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ChatMensagem;

class ChatMensagemSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_quadro' => 1, 'it_id_user_autor' => 1, 'vc_texto_mensagem' => 'Equipa, precisamos acelerar.'],
    ['it_id_quadro' => 2, 'it_id_user_autor' => 2, 'vc_texto_mensagem' => 'Alguém viu o plano?'],
    ['it_id_quadro' => 3, 'it_id_user_autor' => 3, 'vc_texto_mensagem' => 'Reunião amanhã às 12h:30min.'],
    ['it_id_quadro' => 4, 'it_id_user_autor' => 4, 'vc_texto_mensagem' => 'Progresso está fixe!'],
    ['it_id_quadro' => 5, 'it_id_user_autor' => 5, 'vc_texto_mensagem' => 'Confio no vosso trabalho, acho kkk.'],
    ['it_id_quadro' => 6, 'it_id_user_autor' => 6, 'vc_texto_mensagem' => 'Design finalizado hoje?']
  ];

        foreach ($data as $item) {
            ChatMensagem::create($item);
        }
    }
}

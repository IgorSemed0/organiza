<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Anexo;

class AnexoSeeder extends Seeder
{
    public function run()
    {
        $data = [
    ['it_id_cartao' => 1, 'it_id_user_upload' => 1, 'vc_nome_arquivo' => 'banner_draft.jpg', 'vc_caminho_arquivo' => '/uploads/banner_draft.jpg'],
    ['it_id_cartao' => 2, 'it_id_user_upload' => 2, 'vc_nome_arquivo' => 'agenda.pdf', 'vc_caminho_arquivo' => '/uploads/agenda.pdf'],
    ['it_id_cartao' => 3, 'it_id_user_upload' => 3, 'vc_nome_arquivo' => 'teaser.png', 'vc_caminho_arquivo' => '/uploads/teaser.png'],
    ['it_id_cartao' => 4, 'it_id_user_upload' => 4, 'vc_nome_arquivo' => 'bug_report.docx', 'vc_caminho_arquivo' => '/uploads/bug_report.docx'],
    ['it_id_cartao' => 5, 'it_id_user_upload' => 5, 'vc_nome_arquivo' => 'menu_proposta.pdf', 'vc_caminho_arquivo' => '/uploads/menu_proposta.pdf'],
    ['it_id_cartao' => 6, 'it_id_user_upload' => 6, 'vc_nome_arquivo' => 'logo_v1.png', 'vc_caminho_arquivo' => '/uploads/logo_v1.png']
  ];

        foreach ($data as $item) {
            Anexo::create($item);
        }
    }
}

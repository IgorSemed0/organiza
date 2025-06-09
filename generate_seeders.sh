#!/bin/bash

# Exit on error
set -e

# Ensure Laravel project is set up
if [ ! -f "artisan" ]; then
  echo "Error: artisan file not found. Run this script from the Laravel project root."
  exit 1
fi

# Ensure database/seeders directory exists
mkdir -p database/seeders

# Array of table names and corresponding model names
declare -A tables=(
  ["tipo_users"]="TipoUser"
  ["users"]="User"
  ["workplaces"]="Workplace"
  ["quadros"]="Quadro"
  ["listas"]="Lista"
  ["cartaos"]="Cartao"
  ["etiquetas"]="Etiqueta"
  ["anexos"]="Anexo"
  ["comentarios"]="Comentario"
  ["membro_quadros"]="MembroQuadro"
  ["cartao_etiquetas"]="CartaoEtiqueta"
  ["chat_mensagems"]="ChatMensagem"
  ["chat_anexos"]="ChatAnexo"
  ["membro_cartaos"]="MembroCartao"
  ["listas_verificacaos"]="ListaVerificacao"
  ["itens_lista_verificacaos"]="ItemListaVerificacao"
  ["membro_workplaces"]="MembroWorkplace"
  ["membro_quadro_convites"]="MembroQuadroConvite"
  ["membro_workplace_convites"]="MembroWorkplaceConvite"
)

# Data for each table (based on provided SQL inserts)
declare -A inserts=(
  ["tipo_users"]="[
    ['vc_nome' => 'Administrador', 'vc_descricao' => 'Utilizador com permissões completas'],
    ['vc_nome' => 'User', 'vc_descricao' => 'Utilizador com permissões básicas']
  ]"
  ["users"]="[
    ['vc_nome' => 'Administrador', 'vc_email' => 'admin@email.com', 'vc_senha' => '12345678', 'dt_data_registro' => '2025-01-01 10:00:00', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Silvia Clara', 'vc_email' => 'clara@email.com', 'vc_senha' => 'senha123', 'dt_data_registro' => '2025-01-01 10:00:00', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Januário dos Santos', 'vc_email' => 'bruno.costa@email.com', 'vc_senha' => 'abc123', 'dt_data_registro' => '2025-01-02 14:30:00', 'it_id_tipo_user' => 2],
    ['vc_nome' => 'Dário Budjurra', 'vc_email' => 'budjurra@email.com', 'vc_senha' => 'xyz123', 'dt_data_registro' => '2025-01-03 09:15:00', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Isidro de Oliveira', 'vc_email' => 'isidro@email.com', 'vc_senha' => 'pass2025', 'dt_data_registro' => '2025-01-04 16:45:00', 'it_id_tipo_user' => 2],
    ['vc_nome' => 'Eva Pereira', 'vc_email' => 'eva@email.com', 'vc_senha' => 'eva321', 'dt_data_registro' => '2025-01-05 11:20:00', 'it_id_tipo_user' => 1],
    ['vc_nome' => 'Horácio Manuel', 'vc_email' => 'horacio@email.com', 'vc_senha' => '12345678', 'dt_data_registro' => '2025-01-06 13:10:00', 'it_id_tipo_user' => 2]
  ]"
  ["workplaces"]="[
    ['vc_nome' => 'Equipa Marketing', 'vc_descricao' => 'Espaço para campanhas de marketing', 'dt_data_criacao' => '2025-01-10 09:00:00', 'it_id_user_criador' => 1],
    ['vc_nome' => 'Projecto TI', 'vc_descricao' => 'Gestão de desenvolvimento de software', 'dt_data_criacao' => '2025-01-11 14:00:00', 'it_id_user_criador' => 2],
    ['vc_nome' => 'Plano Académico', 'vc_descricao' => 'Organização de tarefas escolares', 'dt_data_criacao' => '2025-01-12 10:30:00', 'it_id_user_criador' => 3],
    ['vc_nome' => 'Evento Corporativo', 'vc_descricao' => 'Planeamento de eventos', 'dt_data_criacao' => '2025-01-13 15:15:00', 'it_id_user_criador' => 4],
    ['vc_nome' => 'Design Gráfico', 'vc_descricao' => 'Projetos de design e branding', 'dt_data_criacao' => '2025-01-14 11:45:00', 'it_id_user_criador' => 5],
    ['vc_nome' => 'Gestão Financeira', 'vc_descricao' => 'Controlo de orçamentos', 'dt_data_criacao' => '2025-01-15 13:20:00', 'it_id_user_criador' => 6]
  ]"
  ["quadros"]="[
    ['it_id_workplace' => 1, 'it_id_user_criador' => 1, 'vc_nome' => 'Campanha Janeiro', 'vc_descricao' => 'Planeamento da campanha de início de ano', 'dt_data_criacao' => '2025-01-16 08:00:00', 'vc_visibilidade' => 'privado'],
    ['it_id_workplace' => 1, 'it_id_user_criador' => 2, 'vc_nome' => 'Redes Sociais', 'vc_descricao' => 'Gestão de posts e conteúdos', 'dt_data_criacao' => '2025-01-17 12:00:00', 'vc_visibilidade' => 'público'],
    ['it_id_workplace' => 2, 'it_id_user_criador' => 3, 'vc_nome' => 'Desenvolvimento App', 'vc_descricao' => 'Tarefas do novo aplicativo', 'dt_data_criacao' => '2025-01-18 09:30:00', 'vc_visibilidade' => 'privado'],
    ['it_id_workplace' => 3, 'it_id_user_criador' => 4, 'vc_nome' => 'Trabalhos Escolares', 'vc_descricao' => 'Organização de entregas', 'dt_data_criacao' => '2025-01-19 14:45:00', 'vc_visibilidade' => 'público'],
    ['it_id_workplace' => 4, 'it_id_user_criador' => 5, 'vc_nome' => 'Evento Anual', 'vc_descricao' => 'Planeamento logístico', 'dt_data_criacao' => '2025-01-20 10:15:00', 'vc_visibilidade' => 'privado'],
    ['it_id_workplace' => 5, 'it_id_user_criador' => 6, 'vc_nome' => 'Logotipo Novo', 'vc_descricao' => 'Criação de identidade visual', 'dt_data_criacao' => '2025-01-21 16:00:00', 'vc_visibilidade' => 'público']
  ]"
  ["listas"]="[
    ['it_id_quadro' => 1, 'vc_nome' => 'A Fazer', 'it_ordem' => 1],
    ['it_id_quadro' => 1, 'vc_nome' => 'Em Progresso', 'it_ordem' => 2],
    ['it_id_quadro' => 2, 'vc_nome' => 'Ideias', 'it_ordem' => 1],
    ['it_id_quadro' => 3, 'vc_nome' => 'Backlog', 'it_ordem' => 1],
    ['it_id_quadro' => 4, 'vc_nome' => 'Pendentes', 'it_ordem' => 1],
    ['it_id_quadro' => 5, 'vc_nome' => 'Concluídos', 'it_ordem' => 1]
  ]"
  ["cartaos"]="[
    ['it_id_lista' => 1, 'it_id_user_criador' => 1, 'vc_titulo' => 'Criar Banner', 'vc_descricao' => 'Banner para campanha de Janeiro', 'dt_data_criacao' => '2025-01-22 09:00:00', 'dt_data_vencimento' => '2025-01-30', 'it_ordem' => 1],
    ['it_id_lista' => 2, 'it_id_user_criador' => 2, 'vc_titulo' => 'Reunião Equipa', 'vc_descricao' => 'Discutir progresso', 'dt_data_criacao' => '2025-01-23 14:00:00', 'dt_data_vencimento' => '2025-01-25', 'it_ordem' => 1],
    ['it_id_lista' => 3, 'it_id_user_criador' => 3, 'vc_titulo' => 'Post Instagram', 'vc_descricao' => 'Publicar teaser da campanha', 'dt_data_criacao' => '2025-01-24 10:30:00', 'dt_data_vencimento' => null, 'it_ordem' => 1],
    ['it_id_lista' => 4, 'it_id_user_criador' => 4, 'vc_titulo' => 'Corrigir Bugs', 'vc_descricao' => 'Resolver erros no app', 'dt_data_criacao' => '2025-01-25 15:00:00', 'dt_data_vencimento' => '2025-02-01', 'it_ordem' => 1],
    ['it_id_lista' => 5, 'it_id_user_criador' => 5, 'vc_titulo' => 'Planeamento Catering', 'vc_descricao' => 'Definir menu do evento', 'dt_data_criacao' => '2025-01-26 11:00:00', 'dt_data_vencimento' => '2025-02-05', 'it_ordem' => 1],
    ['it_id_lista' => 6, 'it_id_user_criador' => 6, 'vc_titulo' => 'Aprovar Design', 'vc_descricao' => 'Revisão final do logotipo', 'dt_data_criacao' => '2025-01-27 13:00:00', 'dt_data_vencimento' => '2025-01-31', 'it_ordem' => 1]
  ]"
  ["etiquetas"]="[
    ['it_id_quadro' => 1, 'vc_nome' => 'Urgente', 'vc_cor' => '#FF0000'],
    ['it_id_quadro' => 2, 'vc_nome' => 'Social Media', 'vc_cor' => '#00FF00'],
    ['it_id_quadro' => 3, 'vc_nome' => 'Prioridade Alta', 'vc_cor' => '#FF4500'],
    ['it_id_quadro' => 4, 'vc_nome' => 'Baixa Prioridade', 'vc_cor' => '#87CEEB'],
    ['it_id_quadro' => 5, 'vc_nome' => 'Logística', 'vc_cor' => '#FFD700'],
    ['it_id_quadro' => 6, 'vc_nome' => 'Design', 'vc_cor' => '#800080']
  ]"
  ["anexos"]="[
    ['it_id_cartao' => 1, 'it_id_user_upload' => 1, 'vc_nome_arquivo' => 'banner_draft.jpg', 'vc_caminho_arquivo' => '/uploads/banner_draft.jpg', 'dt_data_upload' => '2025-01-28 09:30:00'],
    ['it_id_cartao' => 2, 'it_id_user_upload' => 2, 'vc_nome_arquivo' => 'agenda.pdf', 'vc_caminho_arquivo' => '/uploads/agenda.pdf', 'dt_data_upload' => '2025-01-28 14:15:00'],
    ['it_id_cartao' => 3, 'it_id_user_upload' => 3, 'vc_nome_arquivo' => 'teaser.png', 'vc_caminho_arquivo' => '/uploads/teaser.png', 'dt_data_upload' => '2025-01-28 10:45:00'],
    ['it_id_cartao' => 4, 'it_id_user_upload' => 4, 'vc_nome_arquivo' => 'bug_report.docx', 'vc_caminho_arquivo' => '/uploads/bug_report.docx', 'dt_data_upload' => '2025-01-28 15:30:00'],
    ['it_id_cartao' => 5, 'it_id_user_upload' => 5, 'vc_nome_arquivo' => 'menu_proposta.pdf', 'vc_caminho_arquivo' => '/uploads/menu_proposta.pdf', 'dt_data_upload' => '2025-01-28 11:20:00'],
    ['it_id_cartao' => 6, 'it_id_user_upload' => 6, 'vc_nome_arquivo' => 'logo_v1.png', 'vc_caminho_arquivo' => '/uploads/logo_v1.png', 'dt_data_upload' => '2025-01-28 13:10:00']
  ]"
  ["comentarios"]="[
    ['it_id_cartao' => 1, 'it_id_user_autor' => 2, 'vc_texto' => 'O banner precisa de mais contraste.', 'dt_data_criacao' => '2025-01-29 09:00:00'],
    ['it_id_cartao' => 2, 'it_id_user_autor' => 3, 'vc_texto' => 'Confirmada para as 14h.', 'dt_data_criacao' => '2025-01-29 14:00:00'],
    ['it_id_cartao' => 3, 'it_id_user_autor' => 4, 'vc_texto' => 'A imagem está pronta?', 'dt_data_criacao' => '2025-01-29 10:30:00'],
    ['it_id_cartao' => 4, 'it_id_user_autor' => 5, 'vc_texto' => 'Corrigi dois bugs hoje.', 'dt_data_criacao' => '2025-01-29 15:00:00'],
    ['it_id_cartao' => 5, 'it_id_user_autor' => 6, 'vc_texto' => 'Sugiro adicionar sobremesa.', 'dt_data_criacao' => '2025-01-29 11:15:00'],
    ['it_id_cartao' => 6, 'it_id_user_autor' => 1, 'vc_texto' => 'Aprovado com ajustes menores.', 'dt_data_criacao' => '2025-01-29 13:20:00']
  ]"
  ["membro_quadros"]="[
    ['it_id_quadro' => 1, 'it_id_user' => 1, 'vc_funcao' => 'Administrador'],
    ['it_id_quadro' => 1, 'it_id_user' => 2, 'vc_funcao' => 'Editor'],
    ['it_id_quadro' => 2, 'it_id_user' => 3, 'vc_funcao' => 'Membro'],
    ['it_id_quadro' => 3, 'it_id_user' => 4, 'vc_funcao' => 'Gestor'],
    ['it_id_quadro' => 4, 'it_id_user' => 5, 'vc_funcao' => 'Editor'],
    ['it_id_quadro' => 5, 'it_id_user' => 6, 'vc_funcao' => 'Administrador']
  ]"
  ["cartao_etiquetas"]="[
    ['it_id_cartao' => 1, 'it_id_etiqueta' => 1],
    ['it_id_cartao' => 2, 'it_id_etiqueta' => 2],
    ['it_id_cartao' => 3, 'it_id_etiqueta' => 3],
    ['it_id_cartao' => 4, 'it_id_etiqueta' => 4],
    ['it_id_cartao' => 5, 'it_id_etiqueta' => 5],
    ['it_id_cartao' => 6, 'it_id_etiqueta' => 6]
  ]"
  ["chat_mensagems"]="[
    ['it_id_quadro' => 1, 'it_id_user_autor' => 1, 'vc_texto_mensagem' => 'Equipa, precisamos acelerar.', 'dt_data_envio' => '2025-01-30 09:00:00'],
    ['it_id_quadro' => 2, 'it_id_user_autor' => 2, 'vc_texto_mensagem' => 'Alguém viu o plano?', 'dt_data_envio' => '2025-01-30 12:00:00'],
    ['it_id_quadro' => 3, 'it_id_user_autor' => 3, 'vc_texto_mensagem' => 'Reunião amanhã às 12h:30min.', 'dt_data_envio' => '2025-01-30 10:30:00'],
    ['it_id_quadro' => 4, 'it_id_user_autor' => 4, 'vc_texto_mensagem' => 'Progresso está fixe!', 'dt_data_envio' => '2025-01-30 15:00:00'],
    ['it_id_quadro' => 5, 'it_id_user_autor' => 5, 'vc_texto_mensagem' => 'Confio no vosso trabalho, acho kkk.', 'dt_data_envio' => '2025-01-30 11:00:00'],
    ['it_id_quadro' => 6, 'it_id_user_autor' => 6, 'vc_texto_mensagem' => 'Design finalizado hoje?', 'dt_data_envio' => '2025-01-30 13:00:00']
  ]"
  ["chat_anexos"]="[
    ['it_id_chat_mensagem' => 1, 'it_id_user_upload' => 1, 'vc_nome_arquivo' => 'plano.jpg', 'vc_caminho_arquivo' => '/uploads/plano.jpg', 'dt_data_upload' => '2025-01-30 09:05:00'],
    ['it_id_chat_mensagem' => 2, 'it_id_user_upload' => 2, 'vc_nome_arquivo' => 'posts.csv', 'vc_caminho_arquivo' => '/uploads/posts.xlsx', 'dt_data_upload' => '2025-01-30 12:05:00'],
    ['it_id_chat_mensagem' => 3, 'it_id_user_upload' => 3, 'vc_nome_arquivo' => 'descriao?projecto.pdf', 'vc_caminho_arquivo' => '/uploads/agenda_chat.pdf', 'dt_data_upload' => '2025-01-30 10:35:00'],
    ['it_id_chat_mensagem' => 4, 'it_id_user_upload' => 4, 'vc_nome_arquivo' => 'print_do_bug.png', 'vc_caminho_arquivo' => '/uploads/screenshot.png', 'dt_data_upload' => '2025-01-30 15:05:00'],
    ['it_id_chat_mensagem' => 5, 'it_id_user_upload' => 5, 'vc_nome_arquivo' => 'nota.txt', 'vc_caminho_arquivo' => '/uploads/nota.txt', 'dt_data_upload' => '2025-01-30 11:05:00'],
    ['it_id_chat_mensagem' => 6, 'it_id_user_upload' => 6, 'vc_nome_arquivo' => 'logo_final.png', 'vc_caminho_arquivo' => '/uploads/logo_final.png', 'dt_data_upload' => '2025-01-30 13:05:00']
  ]"
  ["membro_cartaos"]="[
    ['it_id_cartao' => 1, 'it_id_user' => 2],
    ['it_id_cartao' => 2, 'it_id_user' => 3],
    ['it_id_cartao' => 3, 'it_id_user' => 4],
    ['it_id_cartao' => 4, 'it_id_user' => 5],
    ['it_id_cartao' => 5, 'it_id_user' => 6],
    ['it_id_cartao' => 6, 'it_id_user' => 1]
  ]"
  ["listas_verificacaos"]="[
    ['it_id_cartao' => 1, 'vc_nome' => 'Design do esquema da DB'],
    ['it_id_cartao' => 2, 'vc_nome' => 'Reunião'],
    ['it_id_cartao' => 3, 'vc_nome' => 'Revisão do esquema da BD'],
    ['it_id_cartao' => 4, 'vc_nome' => 'Resolução de bugs'],
    ['it_id_cartao' => 5, 'vc_nome' => 'Revisão da correçã de gugs'],
    ['it_id_cartao' => 6, 'vc_nome' => 'Revisão final']
  ]"
  ["itens_lista_verificacaos"]="[
    ['it_id_lista_verificacao' => 1, 'vc_texto' => 'Escolher cores', 'bt_completo' => true],
    ['it_id_lista_verificacao' => 2, 'vc_texto' => 'Confirmar participantes', 'bt_completo' => false],
    ['it_id_lista_verificacao' => 3, 'vc_texto' => 'Aprovar texto', 'bt_completo' => true],
    ['it_id_lista_verificacao' => 4, 'vc_texto' => 'Testar funcionalidade', 'bt_completo' => false],
    ['it_id_lista_verificacao' => 5, 'vc_texto' => 'Contactar fornecedor', 'bt_completo' => true],
    ['it_id_lista_verificacao' => 6, 'vc_texto' => 'Verificar tipografia', 'bt_completo' => false]
  ]"
  ["membro_workplaces"]="[
    ['it_id_workplace' => 1, 'it_id_user' => 1, 'vc_funcao' => 'Administrador'],
    ['it_id_workplace' => 2, 'it_id_user' => 2, 'vc_funcao' => 'Gestor'],
    ['it_id_workplace' => 3, 'it_id_user' => 3, 'vc_funcao' => 'Membro'],
    ['it_id_workplace' => 4, 'it_id_user' => 4, 'vc_funcao' => 'Editor'],
    ['it_id_workplace' => 5, 'it_id_user' => 5, 'vc_funcao' => 'Administrador'],
    ['it_id_workplace' => 6, 'it_id_user' => 6, 'vc_funcao' => 'Membro']
  ]"
  ["membro_quadro_convites"]="[
    ['it_id_quadro' => 1, 'it_id_user_convidado' => 2, 'it_id_user_convidador' => 1, 'vc_status' => 'aceite', 'dt_data_envio' => '2025-02-01 09:00:00', 'dt_data_expiracao' => '2025-02-08 09:00:00'],
    ['it_id_quadro' => 2, 'it_id_user_convidado' => 3, 'it_id_user_convidador' => 2, 'vc_status' => 'pendente', 'dt_data_envio' => '2025-02-01 12:00:00', 'dt_data_expiracao' => '2025-02-08 12:00:00'],
    ['it_id_quadro' => 3, 'it_id_user_convidado' => 4, 'it_id_user_convidador' => 3, 'vc_status' => 'recusado', 'dt_data_envio' => '2025-02-01 10:30:00', 'dt_data_expiracao' => '2025-02-08 10:30:00'],
    ['it_id_quadro' => 4, 'it_id_user_convidado' => 5, 'it_id_user_convidador' => 4, 'vc_status' => 'aceite', 'dt_data_envio' => '2025-02-01 15:00:00', 'dt_data_expiracao' => '2025-02-08 15:00:00'],
    ['it_id_quadro' => 5, 'it_id_user_convidado' => 6, 'it_id_user_convidador' => 5, 'vc_status' => 'pendente', 'dt_data_envio' => '2025-02-01 11:00:00', 'dt_data_expiracao' => '2025-02-08 11:00:00'],
    ['it_id_quadro' => 6, 'it_id_user_convidado' => 1, 'it_id_user_convidador' => 6, 'vc_status' => 'aceite', 'dt_data_envio' => '2025-02-01 13:00:00', 'dt_data_expiracao' => '2025-02-08 13:00:00']
  ]"
  ["membro_workplace_convites"]="[
    ['it_id_workplace' => 1, 'it_id_user_convidado' => 3, 'it_id_user_convidador' => 1, 'vc_status' => 'aceite', 'dt_data_envio' => '2025-02-02 09:00:00', 'dt_data_expiracao' => '2025-02-09 09:00:00'],
    ['it_id_workplace' => 2, 'it_id_user_convidado' => 4, 'it_id_user_convidador' => 2, 'vc_status' => 'pendente', 'dt_data_envio' => '2025-02-02 12:00:00', 'dt_data_expiracao' => '2025-02-09 12:00:00'],
    ['it_id_workplace' => 3, 'it_id_user_convidado' => 5, 'it_id_user_convidador' => 3, 'vc_status' => 'recusado', 'dt_data_envio' => '2025-02-02 10:30:00', 'dt_data_expiracao' => '2025-02-09 10:30:00'],
    ['it_id_workplace' => 4, 'it_id_user_convidado' => 6, 'it_id_user_convidador' => 4, 'vc_status' => 'aceite', 'dt_data_envio' => '2025-02-02 15:00:00', 'dt_data_expiracao' => '2025-02-09 15:00:00'],
    ['it_id_workplace' => 5, 'it_id_user_convidado' => 1, 'it_id_user_convidador' => 5, 'vc_status' => 'pendente', 'dt_data_envio' => '2025-02-02 11:00:00', 'dt_data_expiracao' => '2025-02-09 11:00:00'],
    ['it_id_workplace' => 6, 'it_id_user_convidado' => 2, 'it_id_user_convidador' => 6, 'vc_status' => 'aceite', 'dt_data_envio' => '2025-02-02 13:00:00', 'dt_data_expiracao' => '2025-02-09 13:00:00']
  ]"
)

# Generate DatabaseSeeder
cat > database/seeders/DatabaseSeeder.php <<EOL
<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \$this->call([
$(for model in "${!tables[@]}"; do
  echo "            ${tables[$model]}Seeder::class,"
done)
        ]);
    }
}
EOL
echo "Generated DatabaseSeeder.php"

# Generate individual seeders
for table in "${!tables[@]}"; do
  model=${tables[$table]}
  seeder_file="database/seeders/${model}Seeder.php"

  # Special handling for UserSeeder to include bcrypt
  if [ "$model" = "User" ]; then
    cat > "$seeder_file" <<EOL
<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\\$model;
use Illuminate\Support\Facades\Hash;

class ${model}Seeder extends Seeder
{
    public function run()
    {
        \$data = ${inserts[$table]};

        foreach (\$data as \$item) {
            \$item['vc_senha'] = Hash::make(\$item['vc_senha']);
            ${model}::create(\$item);
        }
    }
}
EOL
  else
    cat > "$seeder_file" <<EOL
<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\\$model;

class ${model}Seeder extends Seeder
{
    public function run()
    {
        \$data = ${inserts[$table]};

        foreach (\$data as \$item) {
            ${model}::create(\$item);
        }
    }
}
EOL
  fi
  echo "Generated $seeder_file"
done

echo "All seeders generated successfully."
echo "Run 'php artisan db:seed' to populate the database."

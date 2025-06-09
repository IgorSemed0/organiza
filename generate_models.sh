#!/bin/bash

# Exit on error
set -e

# Ensure Laravel project is set up
if [ ! -f "artisan" ]; then
  echo "Error: artisan file not found. Run this script from the Laravel project root."
  exit 1
fi

# Ensure app/Models directory exists
mkdir -p app/Models

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

# Array of fillable fields for each table
declare -A fillables=(
  ["tipo_users"]="['vc_nome', 'vc_descricao']"
  ["users"]="['vc_nome', 'email', 'password', 'it_id_tipo_user']"
  ["workplaces"]="['vc_nome', 'vc_descricao', 'it_id_user_criador']"
  ["quadros"]="['it_id_workplace', 'it_id_user_criador', 'vc_nome', 'vc_descricao', 'vc_visibilidade']"
  ["listas"]="['it_id_quadro', 'vc_nome', 'it_ordem']"
  ["cartaos"]="['it_id_lista', 'it_id_user_criador', 'vc_titulo', 'vc_descricao', 'dt_data_vencimento', 'it_ordem']"
  ["etiquetas"]="['it_id_quadro', 'vc_nome', 'vc_cor']"
  ["anexos"]="['it_id_cartao', 'it_id_user_upload', 'vc_nome_arquivo', 'vc_caminho_arquivo']"
  ["comentarios"]="['it_id_cartao', 'it_id_user_autor', 'vc_texto']"
  ["membro_quadros"]="['it_id_quadro', 'it_id_user', 'vc_funcao']"
  ["cartao_etiquetas"]="['it_id_cartao', 'it_id_etiqueta']"
  ["chat_mensagems"]="['it_id_quadro', 'it_id_user_autor', 'vc_texto_mensagem']"
  ["chat_anexos"]="['it_id_chat_mensagem', 'it_id_user_upload', 'vc_nome_arquivo', 'vc_caminho_arquivo']"
  ["membro_cartaos"]="['it_id_cartao', 'it_id_user']"
  ["listas_verificacaos"]="['it_id_cartao', 'vc_nome']"
  ["itens_lista_verificacaos"]="['it_id_lista_verificacao', 'vc_texto', 'bt_completo']"
  ["membro_workplaces"]="['it_id_workplace', 'it_id_user', 'vc_funcao']"
  ["membro_quadro_convites"]="['it_id_quadro', 'it_id_user_convidado', 'it_id_user_convidador', 'vc_status']"
  ["membro_workplace_convites"]="['it_id_workplace', 'it_id_user_convidado', 'it_id_user_convidador', 'vc_status']"
)

# Array of relationships for each model
declare -A relationships=(
  ["TipoUser"]="public function users() { return \$this->hasMany(User::class, 'it_id_tipo_user'); }"
  ["User"]="public function tipoUser() { return \$this->belongsTo(TipoUser::class, 'it_id_tipo_user'); }
           public function workplacesCreated() { return \$this->hasMany(Workplace::class, 'it_id_user_criador'); }
           public function quadrosCreated() { return \$this->hasMany(Quadro::class, 'it_id_user_criador'); }
           public function cartaosCreated() { return \$this->hasMany(Cartao::class, 'it_id_user_criador'); }
           public function anexosUploaded() { return \$this->hasMany(Anexo::class, 'it_id_user_upload'); }
           public function comentarios() { return \$this->hasMany(Comentario::class, 'it_id_user_autor'); }
           public function chatMensagems() { return \$this->hasMany(ChatMensagem::class, 'it_id_user_autor'); }
           public function chatAnexosUploaded() { return \$this->hasMany(ChatAnexo::class, 'it_id_user_upload'); }
           public function membroQuadros() { return \$this->hasMany(MembroQuadro::class, 'it_id_user'); }
           public function membroCartaos() { return \$this->hasMany(MembroCartao::class, 'it_id_user'); }
           public function membroWorkplaces() { return \$this->hasMany(MembroWorkplace::class, 'it_id_user'); }
           public function convitesEnviados() { return \$this->hasMany(MembroQuadroConvite::class, 'it_id_user_convidador'); }
           public function convitesRecebidos() { return \$this->hasMany(MembroQuadroConvite::class, 'it_id_user_convidado'); }
           public function workplaceConvitesEnviados() { return \$this->hasMany(MembroWorkplaceConvite::class, 'it_id_user_convidador'); }
           public function workplaceConvitesRecebidos() { return \$this->hasMany(MembroWorkplaceConvite::class, 'it_id_user_convidado'); }"
  ["Workplace"]="public function userCriador() { return \$this->belongsTo(User::class, 'it_id_user_criador'); }
                 public function quadros() { return \$this->hasMany(Quadro::class, 'it_id_workplace'); }
                 public function membros() { return \$this->hasMany(MembroWorkplace::class, 'it_id_workplace'); }
                 public function convites() { return \$this->hasMany(MembroWorkplaceConvite::class, 'it_id_workplace'); }"
  ["Quadro"]="public function workplace() { return \$this->belongsTo(Workplace::class, 'it_id_workplace'); }
              public function userCriador() { return \$this->belongsTo(User::class, 'it_id_user_criador'); }
              public function listas() { return \$this->hasMany(Lista::class, 'it_id_quadro'); }
              public function etiquetas() { return \$this->hasMany(Etiqueta::class, 'it_id_quadro'); }
              public function chatMensagems() { return \$this->hasMany(ChatMensagem::class, 'it_id_quadro'); }
              public function membros() { return \$this->hasMany(MembroQuadro::class, 'it_id_quadro'); }
              public function convites() { return \$this->hasMany(MembroQuadroConvite::class, 'it_id_quadro'); }"
  ["Lista"]="public function quadro() { return \$this->belongsTo(Quadro::class, 'it_id_quadro'); }
             public function cartaos() { return \$this->hasMany(Cartao::class, 'it_id_lista'); }"
  ["Cartao"]="public function lista() { return \$this->belongsTo(Lista::class, 'it_id_lista'); }
              public function userCriador() { return \$this->belongsTo(User::class, 'it_id_user_criador'); }
              public function anexos() { return \$this->hasMany(Anexo::class, 'it_id_cartao'); }
              public function comentarios() { return \$this->hasMany(Comentario::class, 'it_id_cartao'); }
              public function etiquetas() { return \$this->belongsToMany(Etiqueta::class, 'cartao_etiquetas', 'it_id_cartao', 'it_id_etiqueta'); }
              public function membros() { return \$this->hasMany(MembroCartao::class, 'it_id_cartao'); }
              public function listasVerificacaos() { return \$this->hasMany(ListaVerificacao::class, 'it_id_cartao'); }"
  ["Etiqueta"]="public function quadro() { return \$this->belongsTo(Quadro::class, 'it_id_quadro'); }
                public function cartaos() { return \$this->belongsToMany(Cartao::class, 'cartao_etiquetas', 'it_id_etiqueta', 'it_id_cartao'); }"
  ["Anexo"]="public function cartao() { return \$this->belongsTo(Cartao::class, 'it_id_cartao'); }
             public function userUpload() { return \$this->belongsTo(User::class, 'it_id_user_upload'); }"
  ["Comentario"]="public function cartao() { return \$this->belongsTo(Cartao::class, 'it_id_cartao'); }
                  public function userAutor() { return \$this->belongsTo(User::class, 'it_id_user_autor'); }"
  ["MembroQuadro"]="public function quadro() { return \$this->belongsTo(Quadro::class, 'it_id_quadro'); }
                    public function user() { return \$this->belongsTo(User::class, 'it_id_user'); }"
  ["CartaoEtiqueta"]="public function cartao() { return \$this->belongsTo(Cartao::class, 'it_id_cartao'); }
                      public function etiqueta() { return \$this->belongsTo(Etiqueta::class, 'it_id_etiqueta'); }"
  ["ChatMensagem"]="public function quadro() { return \$this->belongsTo(Quadro::class, 'it_id_quadro'); }
                    public function userAutor() { return \$this->belongsTo(User::class, 'it_id_user_autor'); }
                    public function anexos() { return \$this->hasMany(ChatAnexo::class, 'it_id_chat_mensagem'); }"
  ["ChatAnexo"]="public function chatMensagem() { return \$this->belongsTo(ChatMensagem::class, 'it_id_chat_mensagem'); }
                 public function userUpload() { return \$this->belongsTo(User::class, 'it_id_user_upload'); }"
  ["MembroCartao"]="public function cartao() { return \$this->belongsTo(Cartao::class, 'it_id_cartao'); }
                    public function user() { return \$this->belongsTo(User::class, 'it_id_user'); }"
  ["ListaVerificacao"]="public function cartao() { return \$this->belongsTo(Cartao::class, 'it_id_cartao'); }
                        public function itens() { return \$this->hasMany(ItemListaVerificacao::class, 'it_id_lista_verificacao'); }"
  ["ItemListaVerificacao"]="public function listaVerificacao() { return \$this->belongsTo(ListaVerificacao::class, 'it_id_lista_verificacao'); }"
  ["MembroWorkplace"]="public function workplace() { return \$this->belongsTo(Workplace::class, 'it_id_workplace'); }
                       public function user() { return \$this->belongsTo(User::class, 'it_id_user'); }"
  ["MembroQuadroConvite"]="public function quadro() { return \$this->belongsTo(Quadro::class, 'it_id_quadro'); }
                           public function userConvidado() { return \$this->belongsTo(User::class, 'it_id_user_convidado'); }
                           public function userConvidador() { return \$this->belongsTo(User::class, 'it_id_user_convidador'); }"
  ["MembroWorkplaceConvite"]="public function workplace() { return \$this->belongsTo(Workplace::class, 'it_id_workplace'); }
                              public function userConvidado() { return \$this->belongsTo(User::class, 'it_id_user_convidado'); }
                              public function userConvidador() { return \$this->belongsTo(User::class, 'it_id_user_convidador'); }"
)

# Generate model files
for table in "${!tables[@]}"; do
  model=${tables[$table]}
  model_file="app/Models/${model}.php"

  # Generate model content
  cat > "$model_file" <<EOL
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class $model extends Model
{
    use SoftDeletes;

    protected \$table = '$table';

    protected \$fillable = ${fillables[$table]};

    ${relationships[$model]}
}
EOL
  echo "Generated $model_file"
done

echo "All models generated successfully."
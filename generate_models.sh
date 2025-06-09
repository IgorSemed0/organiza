#!/bin/bash

# Exit on error
set -e

# Ensure Laravel project is set up
if [ ! -f "artisan" ]; then
  echo "Error: artisan file not found. Run this script from the Laravel project root."
  exit 1
fi

# Array of model names and their table names
declare -A models=(
  ["TipoUser"]="tipo_users"
  ["User"]="users"
  ["Workplace"]="workplaces"
  ["Quadro"]="quadros"
  ["Lista"]="listas"
  ["Cartao"]="cartaos"
  ["Etiqueta"]="etiquetas"
  ["Anexo"]="anexos"
  ["Comentario"]="comentarios"
  ["MembroQuadro"]="membro_quadros"
  ["CartaoEtiqueta"]="cartao_etiquetas"
  ["ChatMensagem"]="chat_mensagems"
  ["ChatAnexo"]="chat_anexos"
  ["MembroCartao"]="membro_cartaos"
  ["ListaVerificacao"]="listas_verificacaos"
  ["ItemListaVerificacao"]="itens_lista_verificacaos"
  ["MembroWorkplace"]="membro_workplaces"
  ["MembroQuadroConvite"]="membro_quadro_convites"
  ["MembroWorkplaceConvite"]="membro_workplace_convites"
)

# Generate models with fillable and relationships
for model in "${!models[@]}"; do
  table=${models[$model]}
  php artisan make:model "$model" -m
  model_file="app/Models/$model.php"
  
  # Define fillable and relationships based on table
  case $model in
    "TipoUser")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TipoUser extends Model
{
    protected \$table = 'tipo_users';
    protected \$fillable = ['vc_nome', 'vc_descricao'];
    public function users()
    {
        return \$this->hasMany(User::class, 'it_id_tipo_user');
    }
}
"
      ;;
    "User")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected \$table = 'users';
    protected \$fillable = ['vc_nome', 'vc_email', 'vc_senha', 'dt_data_registro', 'it_id_tipo_user'];
    public function tipoUser()
    {
        return \$this->belongsTo(TipoUser::class, 'it_id_tipo_user');
    }
    public function workplaces()
    {
        return \$this->hasMany(Workplace::class, 'it_id_user_criador');
    }
    public function quadros()
    {
        return \$this->hasMany(Quadro::class, 'it_id_user_criador');
    }
    public function cartaos()
    {
        return \$this->hasMany(Cartao::class, 'it_id_user_criador');
    }
    public function anexos()
    {
        return \$this->hasMany(Anexo::class, 'it_id_user_upload');
    }
    public function comentarios()
    {
        return \$this->hasMany(Comentario::class, 'it_id_user_autor');
    }
    public function membroQuadros()
    {
        return \$this->hasMany(MembroQuadro::class, 'it_id_user');
    }
    public function chatMensagens()
    {
        return \$this->hasMany(ChatMensagem::class, 'it_id_user_autor');
    }
    public function chatAnexos()
    {
        return \$this->hasMany(ChatAnexo::class, 'it_id_user_upload');
    }
    public function membroCartaos()
    {
        return \$this->hasMany(MembroCartao::class, 'it_id_user');
    }
    public function membroWorkplaces()
    {
        return \$this->hasMany(MembroWorkplace::class, 'it_id_user');
    }
    public function membroQuadroConvitesConvidado()
    {
        return \$this->hasMany(MembroQuadroConvite::class, 'it_id_user_convidado');
    }
    public function membroQuadroConvitesConvidador()
    {
        return \$this->hasMany(MembroQuadroConvite::class, 'it_id_user_convidador');
    }
    public function membroWorkplaceConvitesConvidado()
    {
        return \$this->hasMany(MembroWorkplaceConvite::class, 'it_id_user_convidado');
    }
    public function membroWorkplaceConvitesConvidador()
    {
        return \$this->hasMany(MembroWorkplaceConvite::class, 'it_id_user_convidador');
    }
}
"
      ;;
    "Workplace")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Workplace extends Model
{
    protected \$table = 'workplaces';
    protected \$fillable = ['vc_nome', 'vc_descricao', 'dt_data_criacao', 'it_id_user_criador'];
    public function userCriador()
    {
        return \$this->belongsTo(User::class, 'it_id_user_criador');
    }
    public function quadros()
    {
        return \$this->hasMany(Quadro::class, 'it_id_workplace');
    }
    public function membroWorkplaces()
    {
        return \$this->hasMany(MembroWorkplace::class, 'it_id_workplace');
    }
    public function membroWorkplaceConvites()
    {
        return \$this->hasMany(MembroWorkplaceConvite::class, 'it_id_workplace');
    }
}
"
      ;;
    "Quadro")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Quadro extends Model
{
    protected \$table = 'quadros';
    protected \$fillable = ['it_id_workplace', 'it_id_user_criador', 'vc_nome', 'vc_descricao', 'dt_data_criacao', 'vc_visibilidade'];
    public function workplace()
    {
        return \$this->belongsTo(Workplace::class, 'it_id_workplace');
    }
    public function userCriador()
    {
        return \$this->belongsTo(User::class, 'it_id_user_criador');
    }
    public function listas()
    {
        return \$this->hasMany(Lista::class, 'it_id_quadro');
    }
    public function etiquetas()
    {
        return \$this->hasMany(Etiqueta::class, 'it_id_quadro');
    }
    public function membroQuadros()
    {
        return \$this->hasMany(MembroQuadro::class, 'it_id_quadro');
    }
    public function chatMensagens()
    {
        return \$this->hasMany(ChatMensagem::class, 'it_id_quadro');
    }
    public function membroQuadroConvites()
    {
        return \$this->hasMany(MembroQuadroConvite::class, 'it_id_quadro');
    }
}
"
      ;;
    "Lista")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Lista extends Model
{
    protected \$table = 'listas';
    protected \$fillable = ['it_id_quadro', 'vc_nome', 'it_ordem'];
    public function quadro()
    {
        return \$this->belongsTo(Quadro::class, 'it_id_quadro');
    }
    public function cartaos()
    {
        return \$this->hasMany(Cartao::class, 'it_id_lista');
    }
}
"
      ;;
    "Cartao")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Cartao extends Model
{
    protected \$table = 'cartaos';
    protected \$fillable = ['it_id_lista', 'it_id_user_criador', 'vc_titulo', 'vc_descricao', 'dt_data_criacao', 'dt_data_vencimento', 'it_ordem'];
    public function lista()
    {
        return \$this->belongsTo(Lista::class, 'it_id_lista');
    }
    public function userCriador()
    {
        return \$this->belongsTo(User::class, 'it_id_user_criador');
    }
    public function anexos()
    {
        return \$this->hasMany(Anexo::class, 'it_id_cartao');
    }
    public function comentarios()
    {
        return \$this->hasMany(Comentario::class, 'it_id_cartao');
    }
    public function cartaoEtiquetas()
    {
        return \$this->hasMany(CartaoEtiqueta::class, 'it_id_cartao');
    }
    public function membroCartaos()
    {
        return \$this->hasMany(MembroCartao::class, 'it_id_cartao');
    }
    public function listasVerificacaos()
    {
        return \$this->hasMany(ListaVerificacao::class, 'it_id_cartao');
    }
}
"
      ;;
    "Etiqueta")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Etiqueta extends Model
{
    protected \$table = 'etiquetas';
    protected \$fillable = ['it_id_quadro', 'vc_nome', 'vc_cor'];
    public function quadro()
    {
        return \$this->belongsTo(Quadro::class, 'it_id_quadro');
    }
    public function cartaoEtiquetas()
    {
        return \$this->hasMany(CartaoEtiqueta::class, 'it_id_etiqueta');
    }
}
"
      ;;
    "Anexo")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Anexo extends Model
{
    protected \$table = 'anexos';
    protected \$fillable = ['it_id_cartao', 'it_id_user_upload', 'vc_nome_arquivo', 'vc_caminho_arquivo', 'dt_data_upload'];
    public function cartao()
    {
        return \$this->belongsTo(Cartao::class, 'it_id_cartao');
    }
    public function userUpload()
    {
        return \$this->belongsTo(User::class, 'it_id_user_upload');
    }
}
"
      ;;
    "Comentario")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Comentario extends Model
{
    protected \$table = 'comentarios';
    protected \$fillable = ['it_id_cartao', 'it_id_user_autor', 'vc_texto', 'dt_data_criacao'];
    public function cartao()
    {
        return \$this->belongsTo(Cartao::class, 'it_id_cartao');
    }
    public function userAutor()
    {
        return \$this->belongsTo(User::class, 'it_id_user_autor');
    }
}
"
      ;;
    "MembroQuadro")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MembroQuadro extends Model
{
    protected \$table = 'membro_quadros';
    protected \$fillable = ['it_id_quadro', 'it_id_user', 'vc_funcao'];
    public function quadro()
    {
        return \$this->belongsTo(Quadro::class, 'it_id_quadro');
    }
    public function user()
    {
        return \$this->belongsTo(User::class, 'it_id_user');
    }
}
"
      ;;
    "CartaoEtiqueta")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CartaoEtiqueta extends Model
{
    protected \$table = 'cartao_etiquetas';
    protected \$fillable = ['it_id_cartao', 'it_id_etiqueta'];
    public function cartao()
    {
        return \$this->belongsTo(Cartao::class, 'it_id_cartao');
    }
    public function etiqueta()
    {
        return \$this->belongsTo(Etiqueta::class, 'it_id_etiqueta');
    }
}
"
      ;;
    "ChatMensagem")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ChatMensagem extends Model
{
    protected \$table = 'chat_mensagems';
    protected \$fillable = ['it_id_quadro', 'it_id_user_autor', 'vc_texto_mensagem', 'dt_data_envio'];
    public function quadro()
    {
        return \$this->belongsTo(Quadro::class, 'it_id_quadro');
    }
    public function userAutor()
    {
        return \$this->belongsTo(User::class, 'it_id_user_autor');
    }
    public function chatAnexos()
    {
        return \$this->hasMany(ChatAnexo::class, 'it_id_chat_mensagem');
    }
}
"
      ;;
    "ChatAnexo")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ChatAnexo extends Model
{
    protected \$table = 'chat_anexos';
    protected \$fillable = ['it_id_chat_mensagem', 'it_id_user_upload', 'vc_nome_arquivo', 'vc_caminho_arquivo', 'dt_data_upload'];
    public function chatMensagem()
    {
        return \$this->belongsTo(ChatMensagem::class, 'it_id_chat_mensagem');
    }
    public function userUpload()
    {
        return \$this->belongsTo(User::class, 'it_id_user_upload');
    }
}
"
      ;;
    "MembroCartao")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MembroCartao extends Model
{
    protected \$table = 'membro_cartaos';
    protected \$fillable = ['it_id_cartao', 'it_id_user'];
    public function cartao()
    {
        return \$this->belongsTo(Cartao::class, 'it_id_cartao');
    }
    public function user()
    {
        return \$this->belongsTo(User::class, 'it_id_user');
    }
}
"
      ;;
    "ListaVerificacao")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ListaVerificacao extends Model
{
    protected \$table = 'listas_verificacaos';
    protected \$fillable = ['it_id_cartao', 'vc_nome'];
    public function cartao()
    {
        return \$this->belongsTo(Cartao::class, 'it_id_cartao');
    }
    public function itens()
    {
        return \$this->hasMany(ItemListaVerificacao::class, 'it_id_lista_verificacao');
    }
}
"
      ;;
    "ItemListaVerificacao")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ItemListaVerificacao extends Model
{
    protected \$table = 'itens_lista_verificacaos';
    protected \$fillable = ['it_id_lista_verificacao', 'vc_texto', 'bt_completo'];
    public function listaVerificacao()
    {
        return \$this->belongsTo(ListaVerificacao::class, 'it_id_lista_verificacao');
    }
}
"
      ;;
    "MembroWorkplace")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MembroWorkplace extends Model
{
    protected \$table = 'membro_workplaces';
    protected \$fillable = ['it_id_workplace', 'it_id_user', 'vc_funcao'];
    public function workplace()
    {
        return \$this->belongsTo(Workplace::class, 'it_id_workplace');
    }
    public function user()
    {
        return \$this->belongsTo(User::class, 'it_id_user');
    }
}
"
      ;;
    "MembroQuadroConvite")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MembroQuadroConvite extends Model
{
    protected \$table = 'membro_quadro_convites';
    protected \$fillable = ['it_id_quadro', 'it_id_user_convidado', 'it_id_user_convidador', 'vc_status', 'dt_data_envio', 'dt_data_expiracao'];
    public function quadro()
    {
        return \$this->belongsTo(Quadro::class, 'it_id_quadro');
    }
    public function userConvidado()
    {
        return \$this->belongsTo(User::class, 'it_id_user_convidado');
    }
    public function userConvidador()
    {
        return \$this->belongsTo(User::class, 'it_id_user_convidador');
    }
}
"
      ;;
    "MembroWorkplaceConvite")
      content="<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MembroWorkplaceConvite extends Model
{
    protected \$table = 'membro_workplace_convites';
    protected \$fillable = ['it_id_workplace', 'it_id_user_convidado', 'it_id_user_convidador', 'vc_status', 'dt_data_envio', 'dt_data_expiracao'];
    public function workplace()
    {
        return \$this->belongsTo(Workplace::class, 'it_id_workplace');
    }
    public function userConvidado()
    {
        return \$this->belongsTo(User::class, 'it_id_user_convidado');
    }
    public function userConvidador()
    {
        return \$this->belongsTo(User::class, 'it_id_user_convidador');
    }
}
"
      ;;
  esac

  # Write content to model file
  echo "$content" > "$model_file"
  echo "Generated $model model for table $table"
done

echo "All models generated successfully."
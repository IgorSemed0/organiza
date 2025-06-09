<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoUser extends Model
{
    use SoftDeletes;

    protected $table = 'tipo_users';

    protected $fillable = ['vc_nome', 'vc_descricao'];

    public function users() { return $this->hasMany(User::class, 'it_id_tipo_user'); }
}

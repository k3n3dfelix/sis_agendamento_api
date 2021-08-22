<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Usuarios extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['descricao','tipo_id','nome','sobrenome','login','senha'];
    protected $primaryKey = 'id_usuario';

    public function tipos()
    {
        return $this->belongsTo('App\Models\Tipos', 'tipo_id');
    }

    public function aulas(){
        return $this->hasMany('App\Models\Aulas', 'usuario_id');
    }

    public function agendas(){
        return $this->hasMany('App\Models\Agenda', 'usuario_id');
    }
}

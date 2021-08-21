<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendas extends Model
{
    use HasFactory;

    protected $fillable = ['aula_id','usuario_id','status','hora','created_at','updated_at'];
    protected $primaryKey = 'id_agenda';

    public function usuarios()
    {
        return $this->belongsTo('App\Models\Usuarios', 'usuario_id');
    }
    public function aulas()
    {
        return $this->belongsTo('App\Models\Aulas', 'aula_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id','materia','data','hora'];
    protected $primaryKey = 'id_aula';

    public function usuarios()
    {
        return $this->belongsTo('App\Models\Usuarios', 'usuario_id');
    }

}

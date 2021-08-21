<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipos extends Model
{
    use HasFactory;

    protected $fillable = ['descricao'];

    public function usuarios(){
        return $this->hasMany('App\Models\Usuarios', 'tipo_id');
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Usuarios extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id_usuario'=>$this->id_usuario,
            'tipo_id'=>$this->tipo_id,
            'nome'=>$this->nome,
            'sobrenome'=>$this->sobrenome,
            'login'=>$this->login,
            'senha'=>$this->senha,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
            
        ];
    }
}

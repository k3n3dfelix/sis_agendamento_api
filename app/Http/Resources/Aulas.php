<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Aulas extends JsonResource
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
            'id_aula'=>$this->id_aula,
            'usuario_id'=>$this->usuario_id,
            'materia'=>$this->materia,
            'data'=>$this->data,
            'hora'=>$this->hora,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
            
        ];
    }
}

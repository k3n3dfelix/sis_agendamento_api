<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Agendas extends JsonResource
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
            'id_agenda'=>$this->id_agenda,
            'aula_id'=>$this->aula_id,
            'usuario_id'=>$this->usuario_id,
            'status'=>$this->status,
            'hora'=>$this->hora,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
            
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResumeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nome' => $this->name,
            'email' => $this->email,
            'telefone' => $this->phone,
            'cargo' => $this->required_position,
            'escolaridade' => $this->educationLevel->name,
            'observação' => $this->obs
        ];
    }
}

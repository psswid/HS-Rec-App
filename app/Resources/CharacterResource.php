<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'mass' => $this->mass,
            'skin_color' => $this->skin_color,
            'birth_year' => $this->birth_year,
            'died_year' => $this->died_year,
            'gender' => $this->gender,
            'culture' => $this->culture,
            'homeworld' => $this->homeworld->name,
            'films' => $this->films->map( function($film) {
                return $film->name;
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

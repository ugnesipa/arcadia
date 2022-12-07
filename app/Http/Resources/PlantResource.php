<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //returns array of plant data
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'climate_id' => $this->climate->id,
            'climate_title' => $this->climate->title,
            'climate_description' => $this->climate->description,
            'origin' => $this->origin,
            'description' => $this->description,

        ];
    }
}

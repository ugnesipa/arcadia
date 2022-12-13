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

        $categories = array();
        foreach ($this->categories as $category) {
            array_push($categories, $category->title);
        }

        //returns array of plant data
        return [
            'id' => $this->id,
            'name' => $this->name,
            'categories' => $categories,
            'climate_id' => $this->climate->id,
            'climate_title' => $this->climate->title,
            'origin' => $this->origin,
            'description' => $this->description,

        ];
    }
}

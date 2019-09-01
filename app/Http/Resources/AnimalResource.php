<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
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
            'type' => new TypeResource($this->type),
            'name' => $this->name,
            'birthday' => $this->birthday,
            'age' => $this->age,
            'area' => $this->area,
            'fix' => $this->fix,
            'description' => $this->description,
            'personality' => $this->personality,
            'created_at' => $this->created_at != null ? $this->created_at->toDateTimeString() : null,
            'updated_at' => $this->updated_at != null ? $this->updated_at->toDateTimeString() : null,
        ];
    }
}

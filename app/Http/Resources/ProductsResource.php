<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            '_id' => $this->_id,
            '_slug' => $this->_slug,
            'thumbnail' => $this->thumbnail,
            'name' => $this->name,
            'price' => $this->price
        ];
    }
}

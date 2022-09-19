<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'category' => $this->category->name,
            'brand' => @$this->brand->name,
            'images' => ImageResource::collection($this->images)
        ];
    }
}

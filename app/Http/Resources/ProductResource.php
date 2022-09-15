<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'code' => $this->code,
            'price' => $this->price,
            'new' => $this->new,
            'points' => $this->points,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'category' => $this->category->name_en,
            'brand' => @$this->brand->name_en,
            'colors' => ColorResource::collection($this->colors),
            'sizes' => SizeResource::collection($this->sizes),
            'images' => ImageResource::collection($this->images)
        ];
    }
}

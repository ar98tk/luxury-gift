<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'code' => $this->code,
            'price' => $this->price,
            'new' => $this->new == 1 ? 'Yes' : 'No',
            'points' => $this->points,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'category' => new CategoryResource($this->category),
            'brand' => new BrandResource(@$this->brand),
            'colors' => ColorResource::collection($this->colors),
            'sizes' => SizeResource::collection($this->sizes),
            'images' => ImageResource::collection($this->images)
        ];
    }
}

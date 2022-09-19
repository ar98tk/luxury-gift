<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'product'  => new CartProductResource($this->product),
            'color'  => new ColorResource($this->color),
            'size'  => new SizeResource($this->size),
            'total_price' => $this->product->price * $this->quantity,
        ];
    }
}

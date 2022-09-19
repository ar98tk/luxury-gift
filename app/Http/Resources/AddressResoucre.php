<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResoucre extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'city' => $this->city->name_en,
            'city_fee' => $this->city->fee,
        ];
    }
}

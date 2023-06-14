<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'food'=>$this->food->name,
            'number'=>$this->count,
            'price'=>0.01*($this->food->price)*(100-($this->food->discount->discountPercent)),
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\CartItem;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $resturant=$this->resturant;
        return [
            'id'=>$this->id,
            'is_pay'=>$this->is_pay ==1 ? 'paid':'unpaid',
            'resturant'=>[
                'name'=>$resturant->name,
                'category'=>$resturant->category->name,
                'foods'=>[
                    CartItemResource::collection($this->cartItems)
                ],
            ],
        ];
    }
}

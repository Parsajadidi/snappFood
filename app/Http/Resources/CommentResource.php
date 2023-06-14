<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $cartItems=$this->cart->cartItems;
        
        $recFood=[];
        foreach($cartItems as $key=>$cartItem){
            $recFood[$key+1]=$cartItem->food->name;
        }
        return [
            "id"=>$this->id,
            "author"=>[
                'name'=>$this->cart->user->name
            ],
            "foods"=>$recFood,
            "score"=>$this->score,
            "content"=>$this->comment,
            "answer"=>$this->answer
        ];
    }
}

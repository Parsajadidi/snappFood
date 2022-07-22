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
        $foods=$this->cart->cartItems->food;
        $recFood=[];
        foreach($foods as $key=>$food){
            $recFood[]=[$key+1=>$food];
        }
        return [
            "id"=>$this->id,
            "author"=>[
                'name'=>$this->cart->user->name
            ],
            "foods"=>$recFood,
            "score"=>$this->score,
            "content"=>$this->comment
        ];
    }
}

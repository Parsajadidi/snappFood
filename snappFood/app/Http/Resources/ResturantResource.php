<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResturantResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'category'=>new CategoryResource($this->category),
            'phone'=>$this->phone,
            'resturant bank account'=>$this->bankAccount,
            'open status'=>$this->is_open,
            'Open Time:'=>new ScheduleResource($this->schedule)
        ];
    }
}

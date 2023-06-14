<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'saturday'=>$this->saturday,
            'sunday'=>$this->sunday,
            'monday'=>$this->monday,
            'tuesday'=>$this->tuesday,
            'wednesday'=>$this->wednesday,
            'thursday'=>$this->thursday,
            'friday'=>$this->friday,
        ];
    }
}

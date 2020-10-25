<?php

namespace App\Http\Resources\Subscribers;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'reg_amount' => $this->reg_amount,
            'discount' => $this->discount,
            'created_at' => $this->created_at,
        ];
    }
}
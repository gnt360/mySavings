<?php

namespace App\Http\Resources\Subscribers;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberDepositResource extends JsonResource
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
            'deposit' => $this->deposit,
            'depositDate' => $this->created_at,
        ];
    }
}
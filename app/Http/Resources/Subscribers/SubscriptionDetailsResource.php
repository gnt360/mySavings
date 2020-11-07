<?php

namespace App\Http\Resources\Subscribers;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionDetailsResource extends JsonResource
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
            'subscriberId' => $this->id,
            'companyName' => $this->name,
            'Category' => $this->subscriberCategory->name,
            'Amount' => $this->subscriberCategory->reg_amount,
            'status' => $this->status,
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
        ];
    }
}
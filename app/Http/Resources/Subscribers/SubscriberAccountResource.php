<?php

namespace App\Http\Resources\Subscribers;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberAccountResource extends JsonResource
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
            'subscriberId' => $this->subscriber_id,
            'accountType' => $this->account_type,
            'accountName' => $this->account_name,
            'currentBalance' => $this->current_balance,
            'creditBalance' => $this->credit_balance,
            'debitBalance' => $this->debit_balance,
            'DateCreated' => $this->created_at
        ];
    }
}
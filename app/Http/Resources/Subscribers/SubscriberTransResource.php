<?php

namespace App\Http\Resources\Subscribers;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberTransResource extends JsonResource
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
            'deposit' => $this->deposit,
            'withdrawal' => $this->withdrawal,
            'accountBalance' => $this->account_balance,
            'Account' => $this->subscriberAccount,
        ];
    }
}
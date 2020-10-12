<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'userName' => auth()->user()->user_name,
            'Email' => auth()->user()->email,
            'BusinessName' => $this->name,
            'status' => $this->status,
            'Image' => $this->image_url,
            'createdDate' => $this->created_at
        ];
    }
}

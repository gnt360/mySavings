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
            'userName' => $this->user_name,
            'Email' => $this->email,
            'Image' => $this->image_url,
            'createdDate' => $this->created_at
        ];
    }
}
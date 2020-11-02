<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'display_name' => $this->display_name,
            'footer' => $this->footer,
            'websiteUrl' => $this->website_url,
            'logo' => $this->logo,
            'contactEmail' => $this->contact_email,
            'contactNumber' => $this->contact_number,
        ];
    }
}

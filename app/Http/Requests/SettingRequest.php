<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'display_name' => ['required', 'string', 'max:255', 'unique:system_settings'],
            'footer' => ['required', 'string'],
            'website_url' => ['required', 'string'],
            'contact_number' => ['required', 'string'],
            'contact_email' => ['required', 'string']
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffDocUploadRequest extends FormRequest
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
            'staff_id' => 'required',
            'file_name' => 'required',
            'file_url' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'staff_id.required' => "The staff field cannot be blank",
            'file_name.required' => "The file name field cannot be blank",
            'file_url.required' => "The file url field cannot be blank"
        ];
    }
}
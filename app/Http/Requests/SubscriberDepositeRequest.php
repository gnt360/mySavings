<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriberDepositeRequest extends FormRequest
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
            'account_id' => 'required',
            'deposit' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'account_id.required' => "Please select an account",
            'deposit.required' => "Add deposit amount",
            'description.required' => "The description field cannot be blank"
        ];
    }
}
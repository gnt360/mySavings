<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriberWithdrawalRequest extends FormRequest
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
            'withdrawal' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'account_id.required' => "Please select an account",
            'withdrawal.required' => "Add withdrawal amount",
            'description.required' => "Please enter a description for this transaction"
        ];
    }
}
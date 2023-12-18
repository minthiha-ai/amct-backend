<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required_without:phone|email|unique:customers,email|max:255',
            'phone' => 'required_without:email|unique:customers,phone,min:6|max:30',
            'password' => 'required|min:6|confirmed|max:255',
            'fcm_token_key' => 'required|string'
        ];
    }
}
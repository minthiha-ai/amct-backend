<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'email' => 'nullable|required_without:phone|email|unique:customers,email,' . $this->customer->id . 'max:255',
            'phone' => 'nullable|required_without:email|unique:customers,phone,' . $this->customer->id . 'min:6|max:30',
        ];
    }
}
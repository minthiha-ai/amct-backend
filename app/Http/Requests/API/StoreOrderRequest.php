<?php

namespace App\Http\Requests\API;

use App\Rules\CartProductExists;
use App\Rules\DeliveryFeeCheck;
use App\Rules\PaymentActiveCheck;
use App\Rules\RegionCodCheck;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:255',
            'address' => 'required',
            'phone' => 'required|max:20',
            'payment_method' => 'required|in:payment,cod',
            'carts' => ['required', 'json', new CartProductExists()],
            'region_id' => 'required|exists:regions,id',
            'delivery_fee_id' => 'required|exists:delivery_fees,id',
            'delivery_fee' => ['required', 'numeric', new DeliveryFeeCheck()],
            'remark' => 'required',
        ];

        if ($this->payment_method == 'payment') {
            $rules['payment_id'] = ['required', 'exists:payments,id', new PaymentActiveCheck()];
            $rules['payment_photo'] = 'required|image';
        }

        if ($this->payment_method == 'cod') {
            $rules['region_id'] = ['required', 'exists:regions,id', new RegionCodCheck];
        }

        return $rules;
    }
}

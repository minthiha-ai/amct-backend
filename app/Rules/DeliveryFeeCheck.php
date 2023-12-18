<?php

namespace App\Rules;

use App\Models\DeliveryFee;
use Illuminate\Contracts\Validation\Rule;

class DeliveryFeeCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $check = DeliveryFee::where('id', request()->delivery_fee_id)->where('region_id',request()->region_id)->where('fee', $value)->exists();
        if (!$check) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Delivery Fee is invalid';
    }
}
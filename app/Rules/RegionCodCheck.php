<?php

namespace App\Rules;

use App\Models\Region;
use Illuminate\Contracts\Validation\Rule;

class RegionCodCheck implements Rule
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
        return Region::where('id',$value)->where('cod','1')->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cash on delivery not avaiable for this region.';
    }
}
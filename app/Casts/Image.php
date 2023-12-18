<?php

namespace App\Casts;

use Illuminate\Support\Str;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Image implements CastsAttributes
{
    /**
     * Add path to the value array(with loop) or string from storage.
     */
    public function get($model, $key, $value, $attributes)
    {
        if (Str::startsWith($value, 'http')) {
            return $value;
        }
        $images = json_decode($value);
        $path   = request()->getSchemeAndHttpHost().'/image/';
        if ($images && is_array($images)) {
            $data = [];
            foreach ($images as $image) {
                if (!empty($image)) {
                    $data[] = $path . $image;
                }
            }
            return $data;
        }
        if (!empty($value)) {
            return $path . $value;
        }
        return request()->getSchemeAndHttpHost() . '/images/logo.jpg';
    }

    /**
     * Set the value directly to the storage.
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
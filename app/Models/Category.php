<?php

namespace App\Models;

use App\Casts\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'image' => Image::class,
    ];

    public function product(){
        return $this->hasMany(Product::class,'category_id','id');
    }
}

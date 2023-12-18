<?php

namespace App\Models;

use App\Models\DeliveryFee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name','cod'
    ];

    public function deliveryFee(){
        return $this->hasMany(DeliveryFee::class,'region_id','id');
    }
}
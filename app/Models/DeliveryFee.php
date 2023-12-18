<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryFee extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
    'region_id','city','fee'
    ];

    public function region(){
        return $this->belongsTo(Region::class,'region_id','id')->withTrashed();
    }
}
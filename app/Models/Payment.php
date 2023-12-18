<?php

namespace App\Models;

use App\Casts\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnValue;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
      'payment_logo','payment_type','name','number', 'status'
    ];

    protected $casts = [
        'payment_logo' => Image::class,
    ];

    public function scopeActivePayment($query){
        return $query->where('status','1');
    }
}
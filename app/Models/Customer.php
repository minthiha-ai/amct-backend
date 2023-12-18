<?php

namespace App\Models;

use App\Models\Order;
use App\Models\FcmTokenKey;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;

     protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'is_banned',
        'fcm_token_key',
    ];

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function order(){
        return $this->hasMany(Order::class,'customer_id','id');
    }

    public function fcmTokenKey()
    {
        return $this->hasMany(FcmTokenKey::class, 'customer_id', 'id');
    }
}
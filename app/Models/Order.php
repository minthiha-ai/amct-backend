<?php

namespace App\Models;

use App\Casts\Image;
use App\Models\Region;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\DeliveryFee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'payment_photo' => Image::class,
        'refund_image' => Image::class,
    ];

    protected $fillable = [
        'customer_id', 'payment_id', 'payment_photo', 'payment_method', 'name', 'phone', 'address',
        'grand_total', 'status', 'refund_date', 'cancel_message', 'refund_message','refund_image',
        'region_id',
        'delivery_fee_id',
        'delivery_fee',
        'sub_total',
        'remark',
    ];

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function customer_name()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->select(['id', 'name']);
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id')->withTrashed();
    }

    public function deliveryFeeRelation()
    {
        return $this->belongsTo(DeliveryFee::class, 'delivery_fee_id', 'id')->withTrashed();
    }

    public function scopeGetRelationData($query)
    {
        return $query->with('orderItem', 'orderItem.product', 'orderItem.product.category', 'orderItem.product.brand', 'orderItem.product.image', 'payment', 'deliveryFeeRelation', 'deliveryFeeRelation.region')->where('customer_id', Auth::guard('api')->user()->id);
    }
}

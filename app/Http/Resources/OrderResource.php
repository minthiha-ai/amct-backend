<?php

namespace App\Http\Resources;

use App\Http\Resources\PaymentResource;
use App\Http\Resources\OrderItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'payment_method' => $this->payment_method,
            'payment_id' => $this->payment_id ?? '',
            'payment_photo' => $this->payment_photo ?? '',

            'name' => $this->name,
            'phone' => $this->phone,

            'region' => $this->deliveryFeeRelation->region->name,
            'city' => $this->deliveryFeeRelation->city,
            'address' => $this->address,
            'delivery_fee' => $this->delivery_fee,

            'sub_total' => $this->sub_total,
            'grand_total' => $this->grand_total,

            'cancel_message' => $this->cancel_message ?? '',
            'refund_date' => $this->refund_date ?? '',
            'refund_message' => $this->refund_message ?? '',
            'refund_image' => $this->refund_image ?? '',

            'status' => $this->status,
            'created_at' => $this->created_at,

            'order_item' => OrderItemResource::collection($this->orderItem),
            'payment' => $this->payment ? new PaymentResource($this->payment) : '',

            'remark' => $this->remark,
        ];
    }
}

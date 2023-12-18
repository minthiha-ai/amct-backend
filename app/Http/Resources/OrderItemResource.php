<?php

namespace App\Http\Resources;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            "order_id"=> $this->order_id,
            "product_id"=> $this->product_id,
            "price"=> $this->price,
            "quantity"=> $this->quantity,
            "total_price"=> $this->total_price,
            "created_at"=> $this->created_at ?? '',
            "model"=> $this->model ?? '',
            "type"=> $this->type ?? '',
            "range"=> $this->range ?? '',
            "product" => new ProductResource($this->product),
        ];
    }
}

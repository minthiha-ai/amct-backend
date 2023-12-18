<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'payment_logo' => $this->payment_logo,
            'payment_type' => $this->payment_type,
            'name' => $this->name,
            'number' => $this->number,
            'created_at' => $this->created_at
        ];
    }
}
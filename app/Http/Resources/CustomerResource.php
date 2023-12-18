<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name' => $this->name,
            'phone' => $this->phone ?? '',
            'email' => $this->email ?? '',
            'fcm_token_key' => $this->fcm_token_key ?? '',
            'is_banned' => $this->is_banned,
            'created_at' => $this->created_at
        ];
    }
}
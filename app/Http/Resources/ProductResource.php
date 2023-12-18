<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $rate = Currency::first();
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "brand" => $this->brand_id ? new BrandResource($this->brand) : '',
            "category" => $this->category_id ? new CategoryResource($this->category) : '',
            "model" => ModalResource::collection($this->modals),
            "type" => TypeResource::collection($this->types),
            "range" => RangeResource::collection($this->ranges),
            "price" => ($this->price) ? number_format(floatval($this->price), 4, '.', '') : number_format(floatval($this->yuan_price*$rate->kyats), 4, '.', ''),
            "yuan_price" => ($this->yuan_price) ? number_format(floatval($this->yuan_price), 4, '.', '') : number_format(floatval($this->price/$rate->kyats), 4, '.', '') ,
            "unit" => $this->unit,
            "status" => $this->status,
            "image" => $this->image->path,
            'instock' => $this->instock,
            "created_at" => $this->created_at,
        ];
    }
}

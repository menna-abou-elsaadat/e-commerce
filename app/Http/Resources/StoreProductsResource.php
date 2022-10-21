<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreProductsResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'product_id' => $this->product_id,
            'product_arabic_name' => $this->product->arabic_name,
            'product_english_name' => $this->product->english_name,
            'product_arabic_description' => $this->product->arabic_description,
            'product_english_description' => $this->product->english_description,
            'product_price' => $this->product_price,
            'vat' => $this->calculateVAT(),
            'product_quantity' => $this->product_quantity
        ];
    }

}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userPurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [

            'total' => $this->total,
            'shipping_cost' => $this->shipping_cost,
        ];
    }
}

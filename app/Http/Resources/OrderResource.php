<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'payment_method' => $this->payment_method,
            'payment_id' => $this->payment_id,
            'user_id' => $this->user_id,
            'products' => ProductCollection::make($this->whenLoaded('products')),
            'orderProducts' => OrderProductCollection::make($this->whenLoaded('orderProducts')),
        ];
    }
}

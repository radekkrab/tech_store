<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'file_path' => $this->file_path,
            'is_active' => $this->is_active,
            'category_id' => $this->category_id,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'tags' => TagCollection::make($this->whenLoaded('tags')),
            'orderProducts' => OrderProductCollection::make($this->whenLoaded('orderProducts')),
        ];
    }
}

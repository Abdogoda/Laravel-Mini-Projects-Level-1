<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image ? asset("storage/uploaded/products/".$this->image) : null,
            
            'category' => new CategoryResource($this->whenLoaded('category')),
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'user' => new UserResource($this->whenLoaded('user')),

            // 'category' => new CategoryResource($this->category),
            // 'brand' => new BrandResource($this->brand),
            // 'user' => new UserResource($this->user),
        ];
    }
}
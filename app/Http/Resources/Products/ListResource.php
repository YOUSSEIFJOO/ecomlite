<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'name' => (string) $this->name,
            'price' => (float) $this->price,
            'stock' => (int) $this->stock,
            'category' => [
                'id' => (string) $this->category->id,
                'name' => (string) $this->category->name,
            ]
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
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
            'sku' => $this->sku,
            'name' => $this->name,
            'picture' => $this->picture,
            'base_price' => $this->base_price,
            'promotion_price' => $this->promotion_price,
            'description' => $this->description,
            'rating' => $this->rating,
            'unit' => $this->unit,
            'order_count' => $this->order_count,
            'quantity_gap' => $this->quantity_gap,
            'tags' => $this->tags,
            'customizations' => new ProductCustomizationCollection($this->customizations),
        ];
    }
}

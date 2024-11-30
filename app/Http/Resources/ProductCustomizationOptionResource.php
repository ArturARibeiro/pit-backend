<?php

namespace App\Http\Resources;

use App\Models\ProductCustomizationOption;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ProductCustomizationOption
 */
class ProductCustomizationOptionResource extends JsonResource
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
            'price_modifier' => $this->price_modifier,
        ];
    }
}

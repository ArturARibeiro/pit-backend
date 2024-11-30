<?php

namespace App\Http\Resources;

use App\Models\ProductCustomization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ProductCustomization
 */
class ProductCustomizationResource extends JsonResource
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
            'type' => $this->type,
            'is_required' => $this->is_required,
            'max_selections' => $this->max_selections,
            'options' => new ProductCustomizationOptionCollection($this->options)
        ];
    }
}

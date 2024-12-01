<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Order
 */
class OrderResource extends JsonResource
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
            'status' => $this->status,
            'date' => $this->date,
            'review' => $this->review,
            'rate' => $this->rate,
            'card' => new CardResource(
                resource: $this->whenLoaded('card'),
            ),
            'address' => new AddressResource(
                resource: $this->whenLoaded('address'),
            ),
            'items' => new OrderItemCollection(
                resource: $this->whenLoaded('items'),
            ),
        ];
    }
}

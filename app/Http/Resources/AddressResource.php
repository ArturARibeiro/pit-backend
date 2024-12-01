<?php

namespace App\Http\Resources;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Address
 */
class AddressResource extends JsonResource
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
            'zip_code' => $this->zip_code,
            'state' => $this->state,
            'city' => $this->city,
            'district' => $this->district,
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,
            'mounted' => "$this->street, $this->district, $this->number, $this->city - $this->state",
        ];
    }
}

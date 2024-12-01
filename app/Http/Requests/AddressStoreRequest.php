<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'zip_code' => 'required|max:9',
            'state' => 'required|max:2',
            'city' => 'required',
            'district' => 'required',
            'street' => 'required',
            'number' => 'required',
            'complement' => 'nullable',
        ];
    }
}

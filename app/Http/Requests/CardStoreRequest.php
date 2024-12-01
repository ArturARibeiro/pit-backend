<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'number' => 'required|string',
            'validity' => 'required|date|date_format:Y-m',
            'cvv' => 'required|string|digits:3',
            'type' => 'required|in:credit,debit',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'created_by' => ['required', 'integer', 'exists:users,id'],
            'reference_number' => ['nullable', 'string', 'max:255'],
            'buyer_name' => ['required', 'string', 'max:255'],
            'buyer_type' => ['nullable', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric', 'gt:0'],
            'sold_at' => ['nullable', 'date'],
            'allocations' => ['required', 'array', 'min:1'],
            'allocations.*.lot_id' => ['required', 'integer', 'exists:lots,id'],
            'allocations.*.quantity' => ['required', 'numeric', 'gt:0'],
            'allocations.*.fee_amount' => ['nullable', 'numeric', 'gte:0'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepositRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_profile_id' => ['required', 'integer', 'exists:member_profiles,id'],
            'waste_category_id' => ['required', 'integer', 'exists:waste_categories,id'],
            'created_by' => ['required', 'integer', 'exists:users,id'],
            'reference_number' => ['nullable', 'string', 'max:255'],
            'quantity' => ['required', 'numeric', 'gt:0'],
            'unit_price' => ['required', 'numeric', 'gte:0'],
            'deposited_at' => ['nullable', 'date'],
        ];
    }
}

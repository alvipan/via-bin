<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWithdrawalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_profile_id' => ['required', 'integer', 'exists:member_profiles,id'],
            'approved_by' => ['nullable', 'integer', 'exists:users,id'],
            'reference_number' => ['nullable', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'gt:0'],
            'status' => ['nullable', 'string', 'in:pending,approved,rejected'],
        ];
    }
}

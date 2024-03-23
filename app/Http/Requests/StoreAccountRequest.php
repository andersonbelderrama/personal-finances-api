<?php

namespace App\Http\Requests;

use App\Enums\AccountType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:50'],
            'branch' => ['nullable', 'max:6'],
            'account_number' => ['required', 'max:12'],
            'active' => ['required', 'boolean'],
            'type' => ['required', Rule::in(AccountType::cases())],
            'balance' => ['required', 'numeric'],
        ];
    }
}

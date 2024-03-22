<?php

namespace App\Http\Requests;

use App\Enums\AccountType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAccountRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'max:50'],
            'branch' => ['sometimes', 'nullable', 'max:6'],
            'account_number' => ['sometimes', 'required', 'max:12'],
            'active' => ['sometimes', 'required', 'boolean'],
            'type' => ['sometimes', 'required', Rule::in(AccountType::cases())],
            'balance' => ['sometimes', 'required', 'numeric'],
        ];
    }
}

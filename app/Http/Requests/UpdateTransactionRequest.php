<?php

namespace App\Http\Requests;

use App\Enums\TransactionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTransactionRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string', 'max:255'],
            'value' => ['sometimes', 'required', 'numeric'],
            'payment_date' => ['sometimes', 'nullable', 'date'],
            'due_date' => ['sometimes', 'nullable', 'date'],
            'type' => ['sometimes', 'required', Rule::in(TransactionType::cases())],
            'is_paid' => ['sometimes', 'required', 'boolean'],
            'category_id' => ['sometimes', 'required', 'exists:categories,id'],
            'account_id' => ['sometimes', 'required', 'exists:accounts,id'],
        ];
    }
}

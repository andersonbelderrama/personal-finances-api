<?php

namespace App\Http\Requests;

use App\Enums\RecurrentFrequency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRecurrentExpenseRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'value' => ['required', 'numeric'],
            'payment_date' => ['nullable', 'date'],
            'due_date' => ['nullable', 'date'],
            'is_paid' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'recurrent_date' => ['required', 'date'],
            'recurrence_frequency' => ['required', Rule::in(RecurrentFrequency::cases())],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'account_id' => ['nullable', 'integer', 'exists:accounts,id'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\DebtPaymentMethod;
use App\Enums\DebtPriority;
use App\Enums\DebtStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDebtRequest extends FormRequest
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
            'name' => ['required', 'max:70'],
            'description' => ['nullable', 'max:255'],
            'priority' => ['required', Rule::in(DebtPriority::cases())],
            'status' => ['required', Rule::in(DebtStatus::cases())],
            'debt_value' => ['required', ],
            'paid_value' => ['numeric'],
            'payment_date' => ['date'],
            'due_date' => ['date'],
            'payment_method' => ['nullable' ,'integer', Rule::in(DebtPaymentMethod::cases())],
            'installments' => [
                Rule::requiredIf(function () {
                    return  $this->payment_method != null && $this->payment_method != DebtPaymentMethod::CASH->value;
                }),
                'nullable',
                'integer',
                'min:1',
                'max:24'
            ],
        ];
    }
}

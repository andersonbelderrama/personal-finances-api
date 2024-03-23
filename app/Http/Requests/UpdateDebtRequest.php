<?php

namespace App\Http\Requests;

use App\Enums\DebtPaymentMethod;
use App\Enums\DebtPriority;
use App\Enums\DebtStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDebtRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'max:70'],
            'description' => ['sometimes','nullable', 'max:255'],
            'priority' => ['sometimes','required', Rule::in(DebtPriority::cases())],
            'status' => ['sometimes','required', Rule::in(DebtStatus::cases())],
            'debt_value' => ['sometimes','required', ],
            'paid_value' => ['sometimes','numeric'],
            'payment_date' => ['sometimes','date'],
            'due_date' => ['sometimes','date'],
            'payment_method' => ['sometimes','nullable' ,'integer', Rule::in(DebtPaymentMethod::cases())],
            'installments' => [
                'sometimes',
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

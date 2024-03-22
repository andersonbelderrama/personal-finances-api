<?php

namespace App\Http\Requests;

use App\Enums\BudgetType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBudgetRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:70'],
            'description' => ['nullable', 'string', 'max:255'],
            'limit_value' => ['required', 'numeric'],
            'type' => ['required', 'integer' , Rule::in(BudgetType::cases())],
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
                'unique:budgets,category_id'
            ],
        ];
    }
}

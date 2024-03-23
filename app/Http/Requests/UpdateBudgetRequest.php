<?php

namespace App\Http\Requests;

use App\Enums\BudgetType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBudgetRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:70'],
            'description' => ['sometimes', 'nullable', 'string', 'max:255'],
            'limit_value' => ['sometimes', 'required', 'numeric'],
            'used_value' => ['sometimes', 'required', 'numeric'],
            'type' => ['sometimes', 'required', 'integer' , Rule::in(BudgetType::cases())],
            'category_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:categories,id',
                Rule::unique('budgets')->where(function ($query) {
                    $query->where('category_id', $this->input('category_id'))
                        ->where('id', '!=', $this->budget->id);
                }),
            ],
        ];
    }
}

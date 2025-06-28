<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => [
                "bail",
                "required",
                "min:3",
                "max:255",
                Rule::unique("categories", "name")->ignore($this->route("id"))
            ],
            "parent_id" => [
                "bail",
                "nullable",
                "numeric",
                "exists:categories,id",
                Rule::notIn([$this->route('id')])
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => __("messages.category_name"),
            "parent_id" => __("messages.parent_category"),
        ];
    }

    public function messages(): array
    {
        return [
            'parent_id.exists' => __("validation.exists", [
                "attribute" => "ID",
                "item" => __("messages.category")
            ]),
            'parent_id.not_in' => __('validation.not_in', [
                'attribute' => __("messages.parent_category")
            ]),
        ];
    }
}

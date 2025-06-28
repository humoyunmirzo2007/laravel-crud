<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ["bail", "required", "min:3", "max:255", "unique:categories,name"],
            "parent_id" => ["bail", "nullable", "numeric", "exists:categories,id"],
        ];
    }


    public function attributes()
    {
        return [
            "name" => __("messages.category_name"),
            "name.exists" => __("validation.exists", ["attribute" => "ID", "item" => __("messages.category")]),
        ];
    }
    public function messages(): array
    {
        return [
            "parent_id.exists" => __("validation.exists", [
                "attribute" => "ID",
                "item" => __("messages.category")
            ]),
        ];
    }
}

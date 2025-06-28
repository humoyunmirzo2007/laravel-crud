<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ["bail", "required", "min:3", "max:255"],
            "price" => ["bail", "required", "numeric", "min:0"],
            "description" => ["bail", "nullable", "max:500"],
            "brand_id" => ["bail", "required", "numeric", "exists:brands,id"],
            "category_id" => ["bail", "required", "numeric", "exists:categories,id"],
            "image" => ["bail", "nullable", "file", "mimes:jpg,jpeg,png", "max:2048"],
        ];
    }


    public function attributes()
    {
        return [
            "name" => __("messages.product_name"),
        ];
    }
    public function messages(): array
    {
        return [
            "brand_id.exists" => __("validation.exists", [
                "attribute" => "ID",
                "item" => __("messages.brand")
            ]),

            "category_id.exists" => __("validation.exists", [
                "attribute" => "ID",
                "item" => __("messages.category")
            ]),
        ];
    }
}

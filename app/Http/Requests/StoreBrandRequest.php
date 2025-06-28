<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required|min:3|max:255|unique:brands,name",
        ];
    }


    public function attributes(): array
    {
        return [
            'name' => __("messages.brand_name"),
        ];
    }
}

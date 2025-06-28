<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "min:3",
                "max:255",
                Rule::unique("brands", "name")->ignore($this->route("id")),
            ],
        ];
    }


    public function attributes(): array
    {
        return [
            'name' => __("messages.brand_name"),
        ];
    }
}

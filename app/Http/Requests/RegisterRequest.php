<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "first_name" => "required|min:3|max:80",
            "last_name" => "required|min:3|max:80",
            "age" => "required|numeric",
            "username" => "required|min:8|max:80|unique:users,username",
            "password" => "required|confirmed|min:8|max:80",
        ];
    }
}

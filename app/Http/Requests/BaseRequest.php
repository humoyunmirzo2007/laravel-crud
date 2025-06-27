<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BaseRequest extends FormRequest
{

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "errors" => $validator->errors(),
        ], 422));
    }

    protected function passedValidation()
    {
        $unexpected = collect($this->all())
            ->keys()
            ->diff(array_keys($this->rules()));

        if ($unexpected->isNotEmpty()) {
            $translated = $unexpected
                ->values()
                ->map(fn($key, $i) => ($i + 1) . ". " . $key)
                ->implode("\n");

            throw new HttpResponseException(response()->json([
                "message" => __("validation.unexpected_fields") . ":\n" . $translated,
            ], 422));
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "type" => ["required", "in:INPUT,OUTPUT"],
            "user_id" => ["required", "integer", "exists:users,id"],
            "products" => ["required", "array", "min:1"],
            "products.*.product_id" => ["required", "integer", "exists:products,id"],
            "products.*.quantity" => ["required", "numeric", "min:0.01"],
        ];
    }

    public function messages(): array
    {
        return [
            'products.*.product_id.required' => 'Mahsulot tanlanmagan.',
            'products.*.product_id.exists' => 'Tanlangan mahsulot mavjud emas.',
            'products.*.quantity.required' => 'Barcha mahsulotlarda miqdor ko‘rsatilishi majburiy.',
            'products.*.quantity.min' => 'Miqdor 0.01 dan kam bo‘lmasligi kerak.',
        ];
    }
}

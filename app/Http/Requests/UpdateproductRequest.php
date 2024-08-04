<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateproductRequest extends FormRequest
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
            "title" => ["required", "string", "max:255"],
            "sku" => ["required", "string", "max:255"],
            "status"=>["required","boolean"],
            "category_id" => ["required", "string"],
            "sub_category_id" => ["required", "string"],
            "brand_id" => ["required", "string"],
            "old_price" => ["required", "string"],
            "price" => ["required", "string"],
            "short_description" => ["required", "string"],
            "description" => ["required", "string"],
            "additional_information" => ["required", "string"],
            "shipping_return" => ["required", "string"],
            "status"=>["required","boolean"],
        ];
    }
}

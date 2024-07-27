<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubCategoryRequest extends FormRequest
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
            "category_id" => ["required", "string"],
            "name" => ["required", "string", "max:255"],
            "slug" => ["required", "string", "max:255"],
            "status"=>["required","boolean"],
            "meta_title" => ["required", "string"],
            "meta_description" => ["required", "string"],
            "meta_keywords" => ["required", "string"],

            ];
    }
}
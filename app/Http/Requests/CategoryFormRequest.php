<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => [
                'required', 'string'
            ],
            'slug' => [
                'required', 'string'
            ],
            'description' => [
                'required',
            ],
            'image' => [
                'nullable', 'mimes:jpg,png,jpeg'
            ],
            'meta_title' => [
                'required', 'string'
            ],
            'meta_keyword' => [
                'required', 'string'
            ],
            'meta_description' => [
                'required', 'string'
            ],
        ];
    }
}

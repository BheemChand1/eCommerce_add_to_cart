<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable','image','max:2048'],
            'images.*' => ['nullable','image','max:2048'],
            'name' => ['required','string','max:255'],
            'price' => ['required','numeric'],
            'productColors.*' => ['required','nullable'],
            'short_description' => ['required','string','max:255'],
            'qty' => ['required','numeric'],
            'sku' => ['required','string','max:255'],
            'description' => ['required','string']
        ];
    }
}

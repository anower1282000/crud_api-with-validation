<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreValidation extends FormRequest
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

        'name'         => ['required', 'string', 'unique:products,name', 'max:255'],
        'category'     => ['required', 'string'],
        'sub_category' => ['nullable', 'string'],
        'price'        => ['required', 'numeric', 'min:0'],
        'brand'        => ['required', 'string'],
        'image'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:10240'],
        'description'  => ['nullable', 'string'],
        'status'       => ['nullable', 'in:active,inactive'],
    
        ];
    }

    public function messages(): array
    {
        return[

         // Custom English messages
        'name.required'     => 'The product name is required.',
        'name.unique'       => 'This product name already exists.',
        'category.required' => 'Please select a category.',
        'price.required'    => 'The product price is required.',
        'price.numeric'     => 'Price must be a valid number.',
        'brand.required'    => 'The brand field cannot be empty.',
        'image.image'       => 'The file must be an image.',
        'image.mimes'       => 'Supported image formats are: jpeg, png, jpg, webp.',
        'image.max'         => 'The image size should not exceed 2MB.',
        'status.in'         => 'Status must be either active or inactive.',
        
        ];
    }
}

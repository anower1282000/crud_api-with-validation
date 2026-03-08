<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateValidation extends FormRequest
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
        $id = $this->route('id'); //id will come here automatically from url

        return [
            'name'         => ['required', 'string','regex:/^[a-zA-Z0-9\s]+$/', 'unique:products,name,' . $id, 'max:255'], //unique:table,column,except ,id-column
            'category'     => ['required','regex:/^[a-zA-Z\s]+$/', 'string'],
            'sub_category' => ['nullable', 'string','regex:/^[a-zA-Z\s\-]+$/'],
            'price'        => ['required', 'numeric', 'min:0'],
            'brand'        => ['required', 'string','regex:/^[a-zA-Z\s]+$/'],
            'image'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:10240'],
            'description'  => ['nullable', 'string'],
            'status'       => ['nullable', 'in:active,inactive'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'The product name is required.',
            'name.unique'       => 'This product name already exists.',
            'price.required'    => 'The product price is required.',
            'image.image'       => 'The file must be an image.',
            'image.max'         => 'The image size should not exceed 2MB.',
        ];
    }
}

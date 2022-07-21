<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:10|max:255',
            'parent_id' => 'required|exists:categories',
            'description' => 'required|min:20|max:255',
            'content' => 'required|min:20',
            'image' => [
                'required',
                'mimes:jpeg,png,jpg,webp',
                'mimetypes:image/jpeg,image/jpg,image/png,image/webp',
                'max:2048',
            ],
            'thumb' => 'required'
        ];
    }
}

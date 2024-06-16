<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPortfolioRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:75', 'min:5'],
            'description' => ['required', 'string', 'max:250', 'min:25'],
            'category' => ['required', 'string', 'max:75', 'min:3'],
            'skills' => ['required', 'string', 'max:120', 'min:3'],
            'media' => 'required|image|mimes:png,jpg,jpeg,img|max:1024',
        ];
    }
}

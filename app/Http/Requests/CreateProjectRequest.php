<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
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
            'description' => ['required', 'string', 'max:512', 'min:50'],
            'category' => ['required', 'string', 'max:255'],
            'pay' => ['nullable', 'integer', 'min:50'],
            'deadline' => ['required', 'integer', 'max:10'],
            'requirement_skills' => ['required', 'string', 'max:255'],

        ];
    }
}

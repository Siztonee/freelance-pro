<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:55', 'min:3'],
            'last_name' => ['required', 'string', 'max:55', 'min:3'],
            'specialization' => ['required', 'string', 'max:75', 'min:3'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1024'],
            'skills' => ['nullable', 'string', 'max:255'],
            'profile_image' => 'nullable|image|mimes:png,jpg,jpeg,img|max:1024',
        ];
    }
}

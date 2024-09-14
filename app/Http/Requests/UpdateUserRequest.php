<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'min:2|max:100',
            'email' => 'email|unique:users,email,'. $this->user,
            'phone' => 'nullable',
            'password' => 'min:8|confirmed',
            'type' => 'in:admin,user,revision'
        ];
    }
}

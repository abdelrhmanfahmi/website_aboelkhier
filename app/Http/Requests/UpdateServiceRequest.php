<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'title' => 'min:1|string',
            'description' => 'min:1',
            'icon' => 'nullable|image|mimes:png,jpg,svg,jpeg',
            'file' => 'nullable|mimes:png,jpg,svg,jpeg,mp4,mov|max:2000'
        ];
    }
}

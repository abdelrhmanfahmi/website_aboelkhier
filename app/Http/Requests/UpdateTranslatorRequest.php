<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTranslatorRequest extends FormRequest
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
            'name' => 'min:2|max:50|string',
            'emails' => 'array|min:1',
            'emails.*.email' => 'min:3|max:50|email|unique:email_translators,email,'. $this->translator->id,
            'phones' => 'array|min:1',
            'phones.*.phone' => 'digits_between:11,20|numeric|unique:email_translators,phone,'.$this->translator->id
        ];
    }
}

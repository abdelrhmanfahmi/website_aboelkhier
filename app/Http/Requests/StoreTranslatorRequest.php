<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTranslatorRequest extends FormRequest
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
            'name' => 'required|min:2|max:50|string',
            'emails' => 'required|array|min:1',
            'emails.*' => 'min:3|max:50|email|unique:email_translators,email',
            'phones' => 'required|array|min:1',
            'phones.*' => 'digits_between:11,20|numeric|unique:email_translators,phone'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResetRequest extends FormRequest
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
            'reset_date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:today',
            'reset_file_names' => 'required|array|min:1',
            'reset_client' => 'required|string|min:3|max:100',
            'client_code' => 'nullable',
            'reset_client_phone' => 'required|numeric|digits_between:9,20',
            'reset_client_phone_second' => 'nullable|numeric|digits_between:9,20',
            'reset_translation' => 'required|in:معتمدة,غير معتمدة,طبي|string',
            'reset_where' => 'required|min:2|max:100',
            'reset_for' => 'required|min:3|max:1000',
            'reset_pages_number' => 'required|min:1|max:100|numeric',
            'reset_name_english' => 'required|min:3|max:1000',
            'reset_total_cost' => 'required|min:1|max:100000|numeric',
            'reset_cost_paid' => 'required|min:0|max:100000|numeric',
            'reset_cost_not_paid' => 'required|min:0|max:100000|numeric',
            'reset_recieved_date' => 'required|date|date_format:Y-m-d H:i:s|after_or_equal:today',
            'reset_notes' => 'nullable',
            'reset_notes_client' => 'nullable',
            'payment_type' => 'required|min:2|max:50',
            'payment_type_two' => 'nullable|string',
            'language_id' => 'required|numeric|exists:languages,id',
            'copy_reset_files' => 'array|min:1',
            'translators' => 'array|min:1',
            'translators.*' => 'nullable|exists:translators,id',
            'translator_notes' => 'nullable',
            'is_scan' => 'required|in:0,1',
            'scan_price' => 'nullable',
            'scan_payment_type' => 'nullable',
            'has_delivered' => 'required|in:0,1',
            'deliver_price' => 'nullable',
            'deliver_payment_type' => 'nullable',
            'has_discount' => 'required|in:0,1',
            'discount_price' => 'nullable',
            'discount_desc' => 'nullable',
            'is_revised' => 'required|in:0,1,2,3',
            'files' => 'array|min:1',
            'files.*' => 'mimes:png,jpg,jpeg,svg,pdf,doc,docx|max:50000',
            'edit_user_id' => 'required',
            'recieved_by' => 'required|in:0,1',
            'recieved_by_name' => 'nullable|string|min:2|max:50',
            'recieved_by_phone' => 'nullable|string|max:20',
            'is_draft' => 'nullable|in:0,1',
            'money_status' => 'nullable|in:0,1',
            'is_payed' => 'nullable|in:0,1',
            'change_reset' => 'nullable|numeric',
            'is_company' => 'nullable|in:0,1'
        ];
    }
}

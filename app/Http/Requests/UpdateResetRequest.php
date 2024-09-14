<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResetRequest extends FormRequest
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
            'reset_date' => 'date_format:Y-m-d H:i:s',
            'reset_file_names' => 'array|min:1',
            'reset_client' => 'string|min:3|max:100',
            'client_code' => 'nullable',
            'reset_client_phone' => 'numeric|digits_between:9,20',
            'reset_client_phone_second' => 'nullable|numeric|digits_between:9,20',
            'reset_translation' => 'in:معتمدة,غير معتمدة,طبي|string',
            'reset_where' => 'min:2|max:100',
            'reset_for' => 'min:3|max:1000',
            'reset_pages_number' => 'min:1|max:100|numeric',
            'reset_name_english' => 'min:3|max:1000',
            'reset_total_cost' => 'min:1|max:100000|numeric',
            'reset_cost_paid' => 'min:0|max:100000|numeric',
            'reset_cost_not_paid' => 'min:0|max:100000|numeric',
            'reset_recieved_date' => 'date_format:Y-m-d H:i:s',
            'reset_notes' => 'nullable',
            'reset_notes_client' => 'nullable',
            'payment_type' => 'min:2|max:50',
            'payment_type_two' => 'nullable|string',
            'language_id' => 'numeric|exists:languages,id',
            'copy_reset_files' => 'array|min:1',
            'translators' => 'array|min:1',
            'translators.*' => 'nullable|exists:translators,id',
            'translator_notes' => 'nullable',
            'is_scan' => 'in:0,1',
            'scan_price' => 'nullable',
            'scan_payment_type' => 'nullable',
            'has_delivered' => 'in:0,1',
            'deliver_price' => 'nullable',
            'deliver_payment_type' => 'nullable',
            'has_discount' => 'in:0,1',
            'discount_price' => 'nullable',
            'discount_desc' => 'nullable',
            'is_revised' => 'in:0,1,2,3',
            'revised_by' => 'exists:users,id',
            'files' => 'array|min:1',
            'files.*' => 'mimes:png,jpg,jpeg,svg,pdf,doc,docx|max:50000',
            'edit_user_id' => 'required',
            'recieved_by' => 'in:0,1',
            'recieved_by_name' => 'string|min:2|max:50',
            'recieved_by_phone' => 'string|max:20',
            'is_draft' => 'nullable|in:0,1',
            'money_status' => 'nullable|in:0,1',
            'is_payed' => 'nullable|in:0,1',
            'change_reset' => 'nullable|numeric',
            'is_company' => 'nullable|in:0,1'
        ];
    }
}

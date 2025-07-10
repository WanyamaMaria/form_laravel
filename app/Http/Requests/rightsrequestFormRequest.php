<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class rightsrequestFormRequest extends FormRequest
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
             'date' => 'required|date',
            'staff_name' => 'required|string',
            'department' => 'required|string',
            'section' => 'required|string',
            'job_title' => 'required|string',
            'rights' => 'required|array|min:1',
            'urgency' => 'required|string',
            'section_manager_name' => 'required|string',
            'section_manager_job_title' => 'required|string',
            'section_manager_signature' => 'required|string',
            'section_manager_date' => 'required|date',
            'hod_name' => 'required|string',
            'hod_job_title' => 'required|string',
            'hod_signature' => 'required|string',
            'hod_date' => 'required|date',
            'finance_head_name' => 'required|string',
            'finance_head_job_title' => 'required|string',
            'finance_head_signature' => 'required|string',
            'finance_head_date' => 'required|date',
        ];
    }
}

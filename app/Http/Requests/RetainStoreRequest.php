<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RetainStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'attorneyID' => ['required', 'max:255', 'string'],
            'caseID' => ['required', 'max:255', 'string'],
            'emplooyID' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'case1_id' => ['required', 'exists:case1s,id'],
            'attorney_id' => ['required', 'exists:attorneys,id'],
            'employee_id' => ['required', 'exists:employees,id'],
        ];
    }
}

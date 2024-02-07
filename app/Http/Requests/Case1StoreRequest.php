<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Case1StoreRequest extends FormRequest
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
            'partyID' => ['required', 'max:255', 'string'],
            'Action' => ['required', 'max:255', 'string'],
            'courtID' => ['required', 'max:255', 'string'],
            'judgeID' => ['required', 'max:255', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'caseTyep' => ['required', 'max:255', 'string'],
            'caseStatus' => ['required', 'max:255', 'string'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
            'caseID' => ['required', 'max:255', 'string'],
            'eventType' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i:s'],
            'location' => ['required', 'max:255', 'string'],
            'outcome' => ['required', 'max:255', 'string'],
            'case1_id' => ['required', 'exists:case1s,id'],
        ];
    }
}

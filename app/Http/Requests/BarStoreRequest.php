<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarStoreRequest extends FormRequest
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
            'bar' => ['required', 'max:255', 'string'],
            'attorney_id' => ['required', 'exists:attorneys,id'],
        ];
    }
}

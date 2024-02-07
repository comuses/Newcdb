<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartyUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'phone' => ['required', 'max:255', 'string'],
            'attonery' => ['required', 'max:255', 'string'],
            'case1_id' => ['required', 'exists:case1s,id'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JudgeUpdateRequest extends FormRequest
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
            'years' => ['required', 'numeric'],
            'courtID' => ['required', 'max:255', 'string'],
            'court_id' => ['required', 'exists:courts,id'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
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
            'name' => 'required|max:255',
            'age' => 'required|numeric|min:18|max:70',
            'avatar' => 'nullable|mimes:jpeg,jpg,png,gif|max:100000',
            'contest_level_id' => 'required|exists:contest_levels,id'
        ];
    }
}

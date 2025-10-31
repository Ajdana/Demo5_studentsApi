<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name'       => 'required|string|min:2|max:255',
            'age'        => 'required|integer|between:16,100',
            'group'      => 'required|string|max:50',
            'email'      => 'required|email|unique:students,email',
            'avatar_url' => 'nullable|url',
        ];
    }
}

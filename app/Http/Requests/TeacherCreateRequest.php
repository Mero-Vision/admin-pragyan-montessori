<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherCreateRequest extends FormRequest
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
            'teacher_name' => ['required','max:255'],
            'dob' => ['required'],
            'email' => ['required', 'email',Rule::unique('teachers','email')],
            'gender' => ['required'],
            'mobile_no' => ['required', 'numeric', Rule::unique('teachers', 'mobile_no')],
            'address' => ['required'],
            'joining_date' => ['required'],
            'education_qualification' => ['required'],
            'position' => ['required'],
        ];
    }
}
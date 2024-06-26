<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentCreateRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'dob' => ['required'],
            'email' => ['nullable', 'email', Rule::unique('students', 'email')],
            'gender' => ['required'],
            'mobile_no' => ['nullable', 'numeric', Rule::unique('students', 'mobile_no')],
            'address' => ['required'],
            'class'=>['required'],
            'monthly_payment_amount'=>['required'],
            'admission_date'=>['required'],
            'guardian_name'=>['required','max:100','string'],
            'profile_image'=>['nullable','image','max:2024']
        
        ];
    }
}
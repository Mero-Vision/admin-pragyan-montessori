<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassTimeTableCreateRequest extends FormRequest
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
            'class' => 'required',
            'day' => 'required',
            'class_times.*' => 'required|array',
            'class_times.*.start_time' => 'required',
            'class_times.*.subject' => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'class_times.*.subject'=>'subject/break'
        ];
    }
}
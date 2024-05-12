<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            // Validasi unik untuk NISN hanya saat membuat data baru
            return [
                'name' => 'required',
                'nisn' => 'required|numeric|unique:students,nisn',
            ];
        } else {
            // Validasi NISN hanya diperlukan saat tidak POST (mungkin PUT atau PATCH)
            return [
                'name' => 'required',
                'nisn' => 'required',
                Rule::unique('students', 'nisn')->ignore($this->student),
            ];
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        // if method is POST
        if ($this->isMethod('POST')) {
            return [
                'name.required' => 'Nama tidak boleh kosong',
                'nisn.required' => 'NISN tidak boleh kosong',
                'nisn.numeric' => 'NISN harus berupa angka',
                'nisn.unique' => 'NISN sudah terdaftar',
            ];
        } else {
            // if method is not POST
            return [
                'name.required' => 'Nama tidak boleh kosong',
                'nisn.required' => 'NISN tidak boleh kosong',
            ];
        }
    }

    // handle a failed validation attempt.
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}

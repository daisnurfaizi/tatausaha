<?php

namespace App\Http\Requests\Tagihan;

use Illuminate\Foundation\Http\FormRequest;

class TagihanRequest extends FormRequest
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
            'siswa' => 'required',
            'month' => 'required',
            'payment_amount' => 'required',
            'payment_date' => 'required',
            'payment_method' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'siswa.required' => 'Siswa tidak boleh kosong',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'payment_amount.required' => 'Jumlah pembayaran tidak boleh kosong',
            'payment_date.required' => 'Tanggal pembayaran tidak boleh kosong',
            'payment_method.required' => 'Metode pembayaran tidak boleh kosong',
            'Keterangan.required' => 'Keterangan tidak boleh kosong',
            'payment_file.required' => 'File pembayaran tidak boleh kosong',
            'payment_file.file' => 'File harus berupa file',
            'payment_file.mimes' => 'File harus berupa pdf, doc, docx, jpg, jpeg, png',
            'payment_file.max' => 'File maksimal 2MB'
        ];
    }
}

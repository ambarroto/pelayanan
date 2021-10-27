<?php

namespace App\Http\Requests\Arsip\PM;

use Illuminate\Foundation\Http\FormRequest;

class TambahRekapDataRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'file' => 'required|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama rekap data perlu diisi.',
            'nama.numeric' => 'Format nama rekap data salah.',
            'nama.max' => 'Maksimal karakter nama rekap data :max.',
            'file.required' => 'File rekap data harus ada.',
            'file.mimes' => 'Format file rekap data yg disarankan : .pdf',
        ];
    }
}
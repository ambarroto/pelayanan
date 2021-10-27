<?php

namespace App\Http\Requests\Arsip\PP;

use Illuminate\Foundation\Http\FormRequest;

class TambahPelayananKTPRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomor_kk' => 'required|string|max:255',
            'nomor_nik_ktp' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'file' => 'required|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'nomor_kk.required' => 'Nomor KK perlu diisi.',
            'nomor_kk.string' => 'Format nomor KK salah.',
            'nomor_kk.max' => 'Maksimal karakter nomor KK :max.',
            'nomor_nik_ktp.required' => 'Nomor NIK perlu diisi.',
            'nomor_nik_ktp.string' => 'Format nomor NIK salah.',
            'nomor_nik_ktp.max' => 'Maksimal karakter nomor NIK :max.',
            'nama.required' => 'Nama perlu diisi.',
            'nama.string' => 'Format nama salah.',
            'nama.max' => 'Maksimal karakter nama :max.',
            'file.required' => 'File KK harus ada.',
            'file.mimes' => 'Format file KK yang disarankan : .pdf',
        ];
    }
}
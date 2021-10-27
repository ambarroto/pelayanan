<?php

namespace App\Http\Requests\Arsip\PP;

use Illuminate\Foundation\Http\FormRequest;

class TambahSKMRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'layanan' => 'required|string|max:255',
            'tahun' => 'required|date_format:Y',
            'bulan' => 'required|date_format:m',
            'jumlah_koresponden' => 'required|integer',
            'hasil' => 'required|numeric',
            'file' => 'nullable|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'layanan.required' => 'Jenis layanan perlu diisi.',
            'layanan.numeric' => 'Format jenis layanan salah.',
            'layanan.max' => 'Maksimal karakter jenis layanan :max.',
            'tahun.required' => 'Tahun penilaian SKM perlu diisi.',
            'tahun.date_format' => 'Format tahun penilaian SKM salah.',
            'bulan.required' => 'Bulan penilaian SKM perlu diisi.',
            'bulan.date_format' => 'Format bulan penilaian SKM salah.',
            'jumlah_koresponsen.required' => 'Jumlah Koresponsen SKM perlu diisi.',
            'jumlah_koresponsen.integer' => 'Format jumlah Koresponden SKM salah.',
            'hasil.required' => 'Hasil SKM perlu diisi.',
            'hasil.numeric' => 'Format hasil SKM salah.',
            'file.mimes' => 'Format file KK yang disarankan : .pdf',
        ];
    }
}
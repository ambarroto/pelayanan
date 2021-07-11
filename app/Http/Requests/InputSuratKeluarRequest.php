<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputSuratKeluarRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomor_surat' => 'required|string',
            'alamat_tujuan' => 'required|string|max:255',
            'tanggal_surat' => 'required|date_format:Y-m-d',
            'perihal' => 'required|string|max:255',
            'penunjuk' => 'string|max:255',
            'lampiran.*' => 'required|mimes:jpeg,jpg,png,pdf',
        ];
    }

    public function messages()
    {
        return [
            'nomor_surat.required' => 'Nomor surat perlu diisi.',
            'nomor_surat.string' => 'Format nomor surat salah.',
            'nomor_surat.max' => 'Maksimal karakter nomor surat :max.',
            'alamat_tujuan.required' => 'Alamat tujuan perlu diisi.',
            'alamat_tujuan.string' => 'Format alamat tujuan salah.',
            'alamat_tujuan.max' => 'Maksimal karakter alamat tujuan :max.',
            'tanggal_surat.required' => 'Tanggal surat perlu diisi.',
            'tanggal_surat.date_format' => 'Format tanggal surat salah',
            'perihal.required' => 'Perihal surat perlu diisi.',
            'perihal.string' => 'Format perihal salah.',
            'perihal.max' => 'Maksimal karakter perihal surat :max.',
            'lampiran.array' => 'Format input file salah.',
            'lampiran.*.mimes' => 'Format file lampiran yg disarankan : .jpeg, .jpg, .pdf, .doc'
        ];
    }
}

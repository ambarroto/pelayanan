<?php

namespace App\Http\Requests\Arsip\Kepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class TambahPendidikanRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_pegawai' => 'required|exists:pegawai,id',
            'nama' => 'required|string|max:255',
            'nomor_ijazah' => 'required|string|max:255',
            'ijazah' => 'required|mimes:pdf',
            'transkrip' => 'nullable|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'id_pegawai.required' => 'Pegawai perlu diisi.',
            'id_pegawai.integer' => 'Format pegawai salah.',
            'id_pegawai.exists' => 'Pegawai tidak ditemukan.',
            'nama.required' => 'Nama pendidikan perlu diisi.',
            'nama.string' => 'Format nama pendidikan salah.',
            'nama.max' => 'Maksimal karakter nama pendidikan :max.',
            'nomor_ijazah.required' => 'Nomor Ijazah perlu diisi.',
            'nomor_ijazah.string' => 'Format nomor ijazah salah.',
            'nomor_ijazah.max' => 'Maksimal karakter nomor ijazah :max.',
            'ijazah.required' => 'File ijazah harus ada.',
            'ijazah.mimes' => 'Format file ijazah disarankan : .pdf',
            'transkrip.required' => 'File transkrip harus ada.',
            'transkrip.mimes' => 'Format file transkrip disarankan : .pdf',
        ];
    }
}
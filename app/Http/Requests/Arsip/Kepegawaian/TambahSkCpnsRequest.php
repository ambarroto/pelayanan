<?php

namespace App\Http\Requests\Arsip\Kepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class TambahSkCpnsRequest extends FormRequest
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
            'nomor_sk' => 'required|string|max:255',
            'tanggal_sk' => 'required|date_format:Y-m-d',
            'file' => 'required|array',
            'file.*' => 'mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'id_pegawai.required' => 'Pegawai perlu diisi.',
            'id_pegawai.integer' => 'Format pegawai salah.',
            'id_pegawai.exists' => 'Pegawai tidak ditemukan.',
            'nomor_sk.required' => 'Nomor SK perlu diisi.',
            'nomor_sk.string' => 'Format nomor SK salah.',
            'nomor_sk.max' => 'Maksimal karakter nomor SK :max.',
            'tanggal_sk.required' => 'Tanggal SK perlu diisi.',
            'tanggal_sk.date_format' => 'Format tanggal SK salah.',
            'file.required' => 'File SK CPNS harus ada.',
            'file.array' => 'Format input file SK CPNS salah.',
            'file.*.required' => 'File SK CPNS harus ada.',
            'file.*.mimes' => 'Format file SK CPNS yg disarankan : .pdf',
        ];
    }
}
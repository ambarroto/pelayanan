<?php

namespace App\Http\Requests\Arsip\Kepegawaian;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TambahSKPRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $tahun = Carbon::now()->format('Y');
        return [
            'id_pegawai' => 'required|exists:pegawai,id',
            'tahun' => 'required|numeric|max:' . $tahun,
            'nilai' => 'required|numeric|max:100',
            'file' => 'required|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'id_pegawai.required' => 'Pegawai perlu diisi.',
            'id_pegawai.integer' => 'Format pegawai salah.',
            'id_pegawai.exists' => 'Pegawai tidak ditemukan.',
            'tahun.required' => 'Tahun SKP perlu diisi.',
            'tahun.integer' => 'Format tahun SKP salah.',
            'tahun.max' => 'Maksimal tahun SKP :max.',
            'nilai.required' => 'Nilai SKP perlu diisi.',
            'nilai.numeric' => 'Format nilai SKP salah (Pisahkan desimal dengan titik).',
            'nilai.max' => 'Maksimal nilai SKP :max.',
            'file.required' => 'File SKP harus ada.',
            'file.mimes' => 'Format file SKP yg disarankan : .pdf',
        ];
    }
}
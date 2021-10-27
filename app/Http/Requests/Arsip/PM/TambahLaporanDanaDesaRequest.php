<?php

namespace App\Http\Requests\Arsip\PM;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TambahLaporanDanaDesaRequest extends FormRequest
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
            'id_desa' => 'required|exists:desa,id',
            'tahun' => 'required|date_format:Y|numeric|max:' . $tahun,
            'anggaran' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'file' => 'required|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'id_desa.required' => 'Desa perlu diisi.',
            'id_desa.integer' => 'Format desa salah.',
            'id_desa.exists' => 'Desa tidak ditemukan.',
            'tahun.required' => 'Tahun laporan dana desa perlu diisi.',
            'tahun.date_format' => 'Format input tahun laporan dana desa tidak sesuai.',
            'tahun.numeric' => 'Format tahun laporan dana desa salah.',
            'tahun.max' => 'Maksimal tahun laporan dana desa :max.',
            'anggaran.required' => 'Anggaran APBDes perlu diisi.',
            'anggaran.numeric' => 'Format anggaran APBDes salah (Pisahkan desimal dengan titik).',
            'realisasi.required' => 'Realisasi APBDes perlu diisi.',
            'realisasi.numeric' => 'Format realisasi APBDes salah (Pisahkan desimal dengan titik).',
            'file.required' => 'File laporan dana desa harus ada.',
            'file.mimes' => 'Format file laporan dana desa yg disarankan : .pdf',
        ];
    }
}
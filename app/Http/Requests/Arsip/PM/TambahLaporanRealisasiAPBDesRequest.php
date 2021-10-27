<?php

namespace App\Http\Requests\Arsip\PM;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TambahLaporanRealisasiAPBDesRequest extends FormRequest
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
            'semester' => 'required|numeric|max:2|min:1',
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
            'tahun.required' => 'Tahun laporan realisasi APBDes perlu diisi.',
            'tahun.date_format' => 'Format input tahun laporan realisasi APBDes tidak sesuai.',
            'tahun.numeric' => 'Format tahun laporan realisasi APBDes salah.',
            'tahun.max' => 'Maksimal tahun laporan realisasi APBDes :max.',
            'semester.required' => 'Semester laporan realisasi APBDes perlu diisi.',
            'semester.numeric' => 'Format semester laporan realisasi APBDes salah.',
            'semester.max' => 'Maksimal semester laporan realisasi APBDes :max.',
            'semester.min' => 'Minimal semester laporan realisasi APBDes :min.',
            'anggaran.required' => 'Anggaran APBDes perlu diisi.',
            'anggaran.numeric' => 'Format anggaran APBDes salah (Pisahkan desimal dengan titik).',
            'realisasi.required' => 'Realisasi APBDes perlu diisi.',
            'realisasi.numeric' => 'Format realisasi APBDes salah (Pisahkan desimal dengan titik).',
            'file.required' => 'File laporan realisasi APBDes harus ada.',
            'file.mimes' => 'Format file laporan realisasi APBDes yg disarankan : .pdf',
        ];
    }
}
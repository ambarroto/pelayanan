<?php

namespace App\Http\Requests\Arsip\PM;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TambahLPJBumdesRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
            'tahun' => 'required|date_format:Y|numeric|max:' . $tahun,
            'file' => 'required|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'id_desa.required' => 'Desa perlu diisi.',
            'id_desa.integer' => 'Format desa salah.',
            'id_desa.exists' => 'Desa tidak ditemukan.',
            'nama.required' => 'Nama BUMDES perlu diisi.',
            'nama.numeric' => 'Format nama BUMDES salah.',
            'nama.max' => 'Maksimal karakter nama BUMDES :max.',
            'tahun.required' => 'Tahun LPJ BUMDES perlu diisi.',
            'tahun.date_format' => 'Format input tahun LPJ BUMDES tidak sesuai.',
            'tahun.numeric' => 'Format tahun LPJ BUMDES salah.',
            'tahun.max' => 'Maksimal tahun LPJ BUMDES :max.',
            'file.required' => 'File LPJ BUMDES harus ada.',
            'file.mimes' => 'Format file LPJ BUMDES yg disarankan : .pdf',
        ];
    }
}
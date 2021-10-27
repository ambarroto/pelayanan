<?php

namespace App\Http\Requests\Arsip\PM;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TambahAdministrasiDesaRequest extends FormRequest
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
            'nama' => 'nullable|string|max:255',
            'tahun' => 'required|date_format:Y|numeric|max:' . $tahun,
            'peruntukan' => 'nullable|string|max:255',
            'file' => 'required|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'id_desa.required' => 'Desa perlu diisi.',
            'id_desa.integer' => 'Format desa salah.',
            'id_desa.exists' => 'Desa tidak ditemukan.',
            'nama.required' => 'Nama file administrasi desa perlu diisi.',
            'nama.numeric' => 'Format nama file administrasi desa salah.',
            'nama.max' => 'Maksimal karakter nama file administrasi desa :max.',
            'tahun.required' => 'Tahun file administrasi desa perlu diisi.',
            'tahun.date_format' => 'Format input tahun file administrasi desa tidak sesuai.',
            'tahun.numeric' => 'Format tahun file administrasi desa salah.',
            'tahun.max' => 'Maksimal tahun file administrasi desa :max.',
            'peruntukan.required' => 'Peruntukan file administrasi desa perlu diisi.',
            'peruntukan.numeric' => 'Format peruntukan file administrasi desa salah.',
            'peruntukan.max' => 'Maksimal karakter peruntukan file administrasi desa :max.',
            'file.required' => 'File administrasi desa harus ada.',
            'file.mimes' => 'Format file administrasi desa yg disarankan : .pdf',
        ];
    }
}
<?php

namespace App\Http\Requests\Administrasi\Seksi;

use Illuminate\Foundation\Http\FormRequest;

class TambahSeksiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'pejabat' => 'required|exists:pegawai,id',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama perlu diisi.',
            'nama.string' => 'Format nama salah.',
            'nama.max' => 'Maksimal karakter nama :max.',
            'pejabat.required' => 'Data pejabat perlu diisi.',
            'pejabat.exists' => 'Pegawai tidak ditemukan.',
        ];
    }
}

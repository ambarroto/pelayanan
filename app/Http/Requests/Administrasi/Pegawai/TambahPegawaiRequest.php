<?php

namespace App\Http\Requests\Administrasi\Pegawai;

use Illuminate\Foundation\Http\FormRequest;

class TambahPegawaiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nip' => 'required|string|max:255',
            'gelar_depan' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
            'gelar_belakang' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'nip.required' => 'NIP perlu diisi.',
            'nip.string' => 'Format NIP salah.',
            'nip.max' => 'Maksimal karakter NIP :max.',
            'gelar_depan.string' => 'Format gelar depan salah.',
            'gelar_depan.max' => 'Maksimal karakter gelar depan :max.',
            'nama.required' => 'Nama perlu diisi.',
            'nama.string' => 'Format nama salah.',
            'nama.max' => 'Maksimal karakter nama :max.',
            'gelar_belakang.string' => 'Format gelar belakang salah.',
            'gelar_belakang.max' => 'Maksimal karakter gelar belakang :max.',
            'no_hp.string' => 'Format nomor HP salah.',
            'no_hp.max' => 'Maksimal karakter nomor HP :max.',
        ];
    }
}

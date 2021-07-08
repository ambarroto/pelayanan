<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputKedatanganRequest extends FormRequest
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
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'asal_desa' => 'required|string|max:255',
            'asal_kecamatan' => 'required|string|max:255',
            'asal_kabupaten' => 'nullable|string|max:255',
            'tujuan_desa' => 'required|string|max:255',
            'jumlah_keluarga' => 'nullable|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama perlu diisi.',
            'nama.string' => 'Format nama salah.',
            'nama.max' => 'Maksimal karakter nama :max.',
            'tempat_lahir.required' => 'Tempat lahir perlu diisi.',
            'tempat_lahir.string' => 'Format tempat lahir salah.',
            'tempat_lahir.max' => 'Maksimal karakter tempat lahir :max.',
            'tanggal_lahir.required' => 'Tanggal larhi perlu diisi.',
            'tanggal_lahir.date_format' => 'Format tanggal larhi salah',
            'asal_desa.required' => 'Asal desa perlu diisi.',
            'asal_desa.string' => 'Format asal desa salah.',
            'asal_desa.max' => 'Maksimal karakter asal desa :max.',
            'asal_kecamatan.required' => 'Asal kecamatan perlu diisi.',
            'asal_kecamatan.string' => 'Format asal kecamatan salah.',
            'asal_kecamatan.max' => 'Maksimal karakter asal kecamatan :max.',
            'asal_kabupaten.string' => 'Format asal kabupaten salah.',
            'asal_kabupaten.max' => 'Maksimal karakter asal kabupaten :max.',
            'tujuan_desa.required' => 'Tujuan desa perlu diisi.',
            'tujuan_desa.string' => 'Format tujuan desa salah.',
            'tujuan_desa.max' => 'Maksimal karakter tujuan desa :max.',
            'jumlah_keluarga.required' => 'Tujuan desa perlu diisi.',
            'jumlah_keluarga.numeric' => 'Format tujuan desa salah.',
            'jumlah_keluarga.min' => 'Jumlah keluarga minimal :min.'
        ];
    }
}

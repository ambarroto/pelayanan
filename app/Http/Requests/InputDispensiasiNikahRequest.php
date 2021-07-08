<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputDispensiasiNikahRequest extends FormRequest
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
            'alamat' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255'
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
            'alamat.required' => 'Alamat perlu diisi.',
            'alamat.string' => 'Format alamat salah.',
            'alamat.max' => 'Maksimal karakter alamat :max.',
            'pekerjaan.required' => 'Pekerjaan perlu diisi.',
            'pekerjaan.string' => 'Format pekerjaan salah.',
            'pekerjaan.max' => 'Maksimal karakter pekerjaan :max.',
            'keterangan.required' => 'Keterangan perlu diisi.',
            'keterangan.string' => 'Format keterangan salah.',
            'keterangan.max' => 'Maksimal karakter keterangan :max.'
        ];
    }
}

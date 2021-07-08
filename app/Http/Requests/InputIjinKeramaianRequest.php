<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputIjinKeramaianRequest extends FormRequest
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
            'umur' => 'nullable|integer|min:1',
            'agama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'hajat' => 'required|string|max:255',
            'jumlah_undangan' => 'nullable|integer|min:0',
            'macam_hiburan' => 'nullable|string|max:255',
            'tanggal_keramaian' => 'required|date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama perlu diisi.',
            'nama.string' => 'Format nama salah.',
            'nama.max' => 'Maksimal karakter nama :max.',
            'umur.integer' => 'Format umur salah.',
            'umur.min' => 'Umur minimal :min tahun.',
            'agama.required' => 'Agama perlu diisi.',
            'agama.string' => 'Format agama salah.',
            'agama.max' => 'Maksimal karakter agama :max.',
            'alamat.required' => 'Alamat perlu diisi.',
            'alamat.string' => 'Format alamat salah.',
            'alamat.max' => 'Maksimal karakter alamat :max.',
            'pekerjaan.required' => 'Pekerjaan perlu diisi.',
            'pekerjaan.string' => 'Format pekerjaan salah.',
            'pekerjaan.max' => 'Maksimal karakter pekerjaan :max.',
            'hajat.required' => 'hajat perlu diisi.',
            'hajat.string' => 'Format hajat salah.',
            'hajat.max' => 'Maksimal karakter hajat :max.',
            'jumlah_undangan.integer' => 'Format jumlah undangan salah.',
            'jumlah_undangan.min' => 'Maksimal karakter jumlah undangan :min.',
            'macam_hiburan.string' => 'Format macam hiburan salah.',
            'macam_hiburan.max' => 'Maksimal karakter macam hiburan :max.',
            'tanggal_keramaian.required' => 'Tanggal keramaian perlu diisi.',
            'tanggal_keramaian.date_format' => 'Format tanggal keramaian salah'
        ];
    }
}

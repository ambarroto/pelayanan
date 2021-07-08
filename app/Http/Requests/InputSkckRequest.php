<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputSkckRequest extends FormRequest
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
            'agama' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'nomor_surat_dari_desa' => 'required|string|max:255|unique:skck,nomor_surat_dari_desa',
            'status' => 'required|string|in:bk,k',
            'nik' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'foto' => 'nullable|mimes:jpeg,jpg,png',
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
            'agama.required' => 'Agama perlu diisi.',
            'agama.string' => 'Format agama salah.',
            'agama.max' => 'Maksimal karakter agama :max.',
            'pendidikan.required' => 'pendidikan perlu diisi.',
            'pendidikan.string' => 'Format pendidikan salah.',
            'pendidikan.max' => 'Maksimal karakter pendidikan :max.',
            'pekerjaan.required' => 'Pekerjaan perlu diisi.',
            'pekerjaan.string' => 'Format pekerjaan salah.',
            'pekerjaan.max' => 'Maksimal karakter pekerjaan :max.',
            'nomor_surat_dari_desa.required' => 'Nomor surat dari desa perlu diisi.',
            'nomor_surat_dari_desa.string' => 'Format nomor surat dari desa salah.',
            'nomor_surat_dari_desa.max' => 'Maksimal karakter nomor surat dari desa :max.',
            'nomor_surat_dari_desa.unique' => 'Nomor surat dari desa sudah terdaftar.',
            'status.required' => 'Status pernikahan perlu diisi.',
            'status.string' => 'Format status pernikahan salah.',
            'status.in' => 'Status pernikahan tidak ada.',
            'keperluan.required' => 'Keperluan perlu diisi.',
            'keperluan.string' => 'Format keperluan salah.',
            'keperluan.max' => 'Maksimal karakter keperluan :max.',
            'nik.required' => 'NIK perlu diisi.',
            'nik.string' => 'Format NIK salah.',
            'nik.max' => 'Maksimal karakter NIK :max.',
            'lampiran.array' => 'Format input file salah.',
            'foto.mimes' => 'Format foto yg disarankan : .jpeg, .jpg, .png'
        ];
    }
}

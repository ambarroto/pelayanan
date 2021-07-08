<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputSuratMasukRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'alamat_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date_format:Y-m-d',
            'nomor_surat' => 'required|string|max:255|unique:surat_masuk,nomor_surat',
            'perihal' => 'required|string',
            'lampiran' => 'array',
            'lampiran.*' => 'required|mimes:jpeg,jpg,png,pdf',
        ];
    }

    public function messages()
    {
        return [
            'tanggal_terima.required' => 'Tanggal terima perlu diisi.',
            'tanggal_terima.date_format' => 'Format tanggal terima salah',
            'alamat_surat.required' => 'Alamat surat perlu diisi.',
            'alamat_surat.string' => 'Format alamat surat salah.',
            'alamat_surat.max' => 'Maksimal karakter alamat surat :max.',
            'tanggal_surat.required' => 'Tanggal surat perlu diisi.',
            'tanggal_surat.date_format' => 'Format tanggal surat salah',
            'nomor_surat.required' => 'Nomor surat perlu diisi.',
            'nomor_surat.string' => 'Format nomor surat salah.',
            'nomor_surat.unique' => 'Nomor surat sudah di input.',
            'nomor_surat.max' => 'Maksimal karakter nomor surat :max.',
            'perihal.required' => 'Perihal surat perlu diisi.',
            'perihal.string' => 'Format perihal salah.',
            'lampiran.array' => 'Format input file salah.',
            'lampiran.*.required' => 'Lampiran harus ada.',
            'lampiran.*.mimes' => 'Format file lampiran yg disarankan : .jpeg, .jpg, .pdf, .doc',
            'nomor_agenda.required' => 'Nomor agenda perlu diisi.',
            'nomor_agenda.string' => 'Format input nomor agenda salah.',
            'nomor_agenda.max' => 'Maksimal karakter nomor agenda :max.',
            'nomor_agenda.unique' => 'Nomor agenda sudah di input.'
        ];
    }
}

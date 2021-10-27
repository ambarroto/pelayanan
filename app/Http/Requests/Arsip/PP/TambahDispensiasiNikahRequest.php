<?php

namespace App\Http\Requests\Arsip\PP;

use Illuminate\Foundation\Http\FormRequest;

class TambahDispensiasiNikahRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomor' => 'required|string|max:255',
            'tanggal' => 'required|date_format:Y-m-d',
            'file' => 'required|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'nomor.required' => 'Nomor dispensiasi nikah perlu diisi.',
            'nomor.numeric' => 'Format nomor dispensiasi nikah salah.',
            'nomor.max' => 'Maksimal karakter nomor dispensiasi nikah :max.',
            'tanggal.required' => 'Tanggal surat dispensiasi nikah perlu diisi.',
            'tanggal.date_format' => 'Format tanggal surat dispensiasi nikah salah.',
            'file.required' => 'File dispensiasi nikah harus ada.',
            'file.mimes' => 'Format file dispensiasi nikah yang disarankan : .pdf',
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSuratMasukRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'isi_disposisi' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'isi_disposisi.required' => 'Isi disposisi surat perlu diisi.',
            'isi_disposisi.string' => 'Format isi disposisi surat salah.',
            'isi_disposisi.max' => 'Maksimal karakter isi disposisi surat :max.'
        ];
    }
}

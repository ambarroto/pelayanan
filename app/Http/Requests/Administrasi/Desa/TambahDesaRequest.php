<?php

namespace App\Http\Requests\Administrasi\Desa;

use Illuminate\Foundation\Http\FormRequest;

class TambahDesaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kode' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'kode.string' => 'Format gelar depan salah.',
            'kode.max' => 'Maksimal karakter gelar depan :max.',
            'nama.required' => 'Nama perlu diisi.',
            'nama.string' => 'Format nama salah.',
            'nama.max' => 'Maksimal karakter nama :max.',
        ];
    }
}

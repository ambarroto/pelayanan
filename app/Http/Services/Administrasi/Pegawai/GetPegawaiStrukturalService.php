<?php

namespace App\Http\Services\Administrasi\Pegawai;

use App\Models\Administrasi\Pegawai;

class GetPegawaiStrukturalService
{
    public function get()
    {
        return Pegawai::select('id', 'nama')->get();
    }
}
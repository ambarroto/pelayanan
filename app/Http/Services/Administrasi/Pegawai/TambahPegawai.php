<?php

namespace App\Http\Services\Administrasi\Pegawai;

use App\Models\Administrasi\Pegawai;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TambahPegawai
{
    /**
     * Tambah data pegawai baru
     * 
     * @param string $nip
     * @param string $nama
     * @param string|null $gelar_depan
     * @param string|null $gelar_belakang
     * @param string|null $no_hp
     * @return Pegawai
     */
    public function tambah(string $nip, string $nama, string $gelar_depan = null, string $gelar_belakang = null, string $no_hp = null): Pegawai
    {
        try {
            $pegawai = Pegawai::create([
                'nip' => $nip,
                'nama' => $nama,
                'gelar_depan' => $gelar_depan,
                'gelar_belakang' => $gelar_belakang,
                'no_hp' => $no_hp
            ]);
        } catch (\Throwable $th) {
            throw new BadRequestException('Gagal menambah data pegawai');
        }
        return $pegawai;
    }
}
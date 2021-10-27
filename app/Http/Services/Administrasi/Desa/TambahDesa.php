<?php

namespace App\Http\Services\Administrasi\Desa;

use App\Models\Administrasi\Desa;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TambahDesa
{
    /**
     * Tambah data desa baru
     * 
     * @param string|null $kode
     * @param string $nama
     * @return Desa
     */
    public function tambah(string $kode = null, string $nama): Desa
    {
        try {
            $desa = Desa::create([
                'kode' => $kode,
                'nama' => $nama
            ]);
        } catch (\Throwable $th) {
            throw new BadRequestException('Gagal menambah data desa.');
        }
        return $desa;
    }
}
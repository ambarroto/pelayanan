<?php

namespace App\Http\Services\Seksi;

use App\Models\Administrasi\Seksi;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TambahSeksi
{
    /**
     * Tambah data seksi / subbag baru
     * 
     * @param string $nama
     * @param int|null $pejabat
     * @return Seksi
     */
    public function tambah(string $nama, int $pejabat = null): Seksi
    {
        try {
            $seksi = Seksi::create([
                'nama' => $nama,
                'pejabat' => $pejabat
            ]);
        } catch (\Throwable $th) {
            throw new BadRequestException('Gagal menambah data seksi / subbag.');
        }
        return $seksi;
    }
}
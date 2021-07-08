<?php

namespace App\Http\Services;

use App\Models\Kedatangan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class InputKedatanganService
{
    /**
     * Input data kedatangan penduduk baru
     * 
     * @param string $nama
     * @param string $tempat_lahir
     * @param string $tanggal_lahir
     * @param string $asal_desa
     * @param string $asal_kecamatan
     * @param string|null $asal_kabupaten
     * @param string $tujuan_desa
     * @param float $jumlah_keluarga
     * @return \App\Models\Kedatangan
     */
    public function input(string $nama, string $tempat_lahir, string $tanggal_lahir, string $asal_desa, string $asal_kecamatan, string $asal_kabupaten = null, string $tujuan_desa, float $jumlah_keluarga = 0): Kedatangan
    {
        DB::beginTransaction();
        $tanggal_lahir = validasi_tanggal($tanggal_lahir, 'tanggal lahir');
        $tahun = Carbon::now()->format('Y');
        $nomor = get_nomor(new Kedatangan());
        try {
            $kedatangan = Kedatangan::create([
                'nomor' => $nomor,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'asal_desa' => $asal_desa,
                'asal_kecamatan' => $asal_kecamatan,
                'asal_kabupaten' => $asal_kabupaten,
                'tujuan_desa' => $tujuan_desa,
                'jumlah_keluarga' => $jumlah_keluarga
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        DB::commit();
        return $kedatangan;
    }
}
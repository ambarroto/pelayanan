<?php

namespace App\Http\Services;

use App\Models\SuratKeterangan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class InputSuratKeteranganService
{
    /**
     * Input data surat keterangan
     * 
     * @param string $nama
     * @param string $tempat_lahir
     * @param string $tanggal_lahir
     * @param string $alamat
     * @param string $pekerjaan
     * @param string $keterangan
     * @return \App\Models\SuratKeterangan
     */
    public function input(string $nama, string $tempat_lahir, string $tanggal_lahir, string $alamat, string $pekerjaan, string $keterangan): SuratKeterangan
    {
        DB::beginTransaction();
        $nomor = get_nomor(new SuratKeterangan());
        $tanggal_lahir = validasi_tanggal($tanggal_lahir);
        try {
            $surat_keterangan = SuratKeterangan::create([
                'nomor' => $nomor,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'alamat' => $alamat,
                'pekerjaan' => $pekerjaan,
                'keterangan' => $keterangan,
                'status' => SuratKeterangan::STATUS_SUCCESS
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah data surat keterangan");
        }
        DB::commit();
        return $surat_keterangan;
    }
}
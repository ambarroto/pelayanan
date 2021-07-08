<?php

namespace App\Http\Services;

use App\Models\IjinKeramaian;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class InputIjinKeramaianService
{
    /**
     * Input data ijin keramaian
     * 
     * @param string $nama
     * @param float|null $umur
     * @param string $agama
     * @param string $alamat
     * @param string $pekerjaan
     * @param string $hajat
     * @param float|null $jumlah_undangan
     * @param string|null $macam_hiburan
     * @param string $tanggal_keramaian
     * @return \App\Models\IjinKeramaian
     */
    public function input(string $nama, float $umur = null, string $agama, string $alamat, string $pekerjaan, string $hajat, float $jumlah_undangan = null, string $macam_hiburan = null, string $tanggal_keramaian): IjinKeramaian
    {
        DB::beginTransaction();
        $tanggal_keramaian = validasi_tanggal($tanggal_keramaian, 'tanggal lahir');
        $nomor = get_nomor(new IjinKeramaian());
        try {
            $ijin_keramaian = IjinKeramaian::create([
                'nomor' => $nomor,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'nama' => $nama,
                'umur' => $umur,
                'agama' => $agama,
                'alamat' => $alamat,
                'pekerjaan' => $pekerjaan,
                'hajat' => $hajat,
                'jumlah_undangan' => $jumlah_undangan,
                'macam_hiburan' => $macam_hiburan,
                'tanggal_keramaian' => $tanggal_keramaian,
                'status' => IjinKeramaian::STATUS_SUCCESS
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambahkan ijin keramaian.");
        }
        DB::commit();
        return $ijin_keramaian;
    }
}
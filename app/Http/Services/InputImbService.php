<?php

namespace App\Http\Services;

use App\Models\Imb;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class InputImbService
{
    /**
     * Input data IMB
     * 
     * @param string $nama
     * @param string $tempat_lahir
     * @param string $tanggal_lahir
     * @param string $alamat
     * @param string $pekerjaan
     * @param string $keterangan
     * @param string|null $nomor_hp
     * @return \App\Models\Imb
     */
    public function input(string $nama, string $tempat_lahir, string $tanggal_lahir, string $alamat, string $pekerjaan, string $keterangan, string $nomor_hp = null): Imb
    {
        DB::beginTransaction();
        $tanggal_lahir = validasi_tanggal($tanggal_lahir, 'tanggal lahir');
        $nomor = get_nomor(new Imb());
        try {
            $imb = Imb::create([
                'nomor' => $nomor,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'alamat' => $alamat,
                'pekerjaan' => $pekerjaan,
                'keterangan' => $keterangan,
                'nomor_hp' => $nomor_hp,
                'status' => Imb::STATUS_ACTIVE
            ]);
        } catch (\Throwable $th) {
            throw new BadRequestException("Gagal menambah data IMB.");
        }
        DB::commit();
        return $imb;
    }
}
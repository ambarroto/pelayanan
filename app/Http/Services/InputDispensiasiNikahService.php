<?php

namespace App\Http\Services;

use App\Models\DispensiasiNikah;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class InputDispensiasiNikahService
{
    /**
     * Input data dispensiasi nikah
     * 
     * @param string $nama
     * @param string $tempat_lahir
     * @param string $tanggal_lahir
     * @param string $pekerjaan
     * @param string $alamat
     * @param string $keterangan
     * @return \App\Models\DispensiasiNikah
     */
    public function input(string $nama, string $tempat_lahir,string $tanggal_lahir, string $pekerjaan, string $alamat, string $keterangan): DispensiasiNikah
    {
        DB::beginTransaction();
        $nomor = get_nomor(new DispensiasiNikah());
        $tanggal = Carbon::now();
        $tanggal_lahir = validasi_tanggal($tanggal_lahir, 'tanggal lahir');
        try {
            $dispensiasi_nikah = DispensiasiNikah::create([
                'nomor' => $nomor,
                'tanggal' => $tanggal,
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'pekerjaan' => $pekerjaan,
                'alamat' => $alamat,
                'keterangan' => $keterangan,
                'status' => DispensiasiNikah::STATUS_SUCCESS
            ]);
        } catch (\Throwable $th) {
            throw new BadRequestException("Gagal menambah data dispensiasi nikah.");
        }
        DB::commit();
        return $dispensiasi_nikah;
    }
}
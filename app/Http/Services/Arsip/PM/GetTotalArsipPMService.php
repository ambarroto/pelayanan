<?php

namespace App\Http\Services\Arsip\PM;

use App\Models\Arsip\PM\AdministrasiDesa;
use App\Models\Arsip\PM\LaporanAlokasiDanaDesa;
use App\Models\Arsip\PM\LaporanDanaDesa;
use App\Models\Arsip\PM\LaporanRealisasiAPBDes;
use App\Models\Arsip\PM\LPJBumdes;
use App\Models\Arsip\PM\RekapData;

class GetTotalArsipPMService
{
    /**
     * Get all total arsip PM
     * 
     * @return mixed
     */
    public static function get()
    {
        $total_arsip_administrasi_desa = AdministrasiDesa::count();
        $total_arsip_laporan_alokasi_dana_desa = LaporanAlokasiDanaDesa::count();
        $total_arsip_laporan_dana_desa = LaporanDanaDesa::count();
        $total_arsip_laporan_realisasi_apbdes = LaporanRealisasiAPBDes::count();
        $total_arsip_lpj_bumdes = LPJBumdes::count();
        $total_arsip_rekap_data = RekapData::count();
        $total = collect([$total_arsip_administrasi_desa, $total_arsip_laporan_alokasi_dana_desa, $total_arsip_laporan_dana_desa, $total_arsip_laporan_realisasi_apbdes, $total_arsip_lpj_bumdes, $total_arsip_rekap_data])->sum();
        return $total;
    }
}
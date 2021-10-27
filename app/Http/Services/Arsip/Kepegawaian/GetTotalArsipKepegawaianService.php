<?php

namespace App\Http\Services\Arsip\Kepegawaian;

use App\Models\Arsip\Kepegawaian\Pangkat;
use App\Models\Arsip\Kepegawaian\Pendidikan;
use App\Models\Arsip\Kepegawaian\SkCpns;
use App\Models\Arsip\Kepegawaian\SKP;
use App\Models\Arsip\Kepegawaian\SkPns;

class GetTotalArsipKepegawaianService
{
    /**
     * Mengambil total semuar arsip kepegawaian
     * 
     * @return mixed
     */
    public static function get()
    {
        $total_arsip_sk_cpns = SkCpns::count();
        $total_arsip_sk_pns = SkPns::count();
        $total_arsip_pendidikan = Pendidikan::count();
        $total_arsip_kenaikan_pangkat = Pangkat::count();
        $total_arsip_skp = SKP::count();
        return collect([$total_arsip_kenaikan_pangkat, $total_arsip_pendidikan, $total_arsip_sk_cpns, $total_arsip_sk_pns, $total_arsip_skp])->sum();
    }
}
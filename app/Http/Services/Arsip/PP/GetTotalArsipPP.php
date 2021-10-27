<?php

namespace App\Http\Services\Arsip\PP;

use App\Models\Arsip\PP\DispensiasiNikah;
use App\Models\Arsip\PP\PelayananKTP;
use App\Models\Arsip\PP\SKM;

class GetTotalArsipPP
{
    /**
     * Get total arsip PP
     * 
     * @return mixed
     */
    public static function get()
    {
        $total_arsip_dispensiasi_nikah = DispensiasiNikah::count();
        $total_arsip_pelayanan_ktp = PelayananKTP::count();
        $total_arsip_skm = SKM::count();
        $total = collect([$total_arsip_dispensiasi_nikah, $total_arsip_pelayanan_ktp, $total_arsip_skm])->sum();
        return $total;
    }
}
<?php

namespace App\Models\Arsip;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    const SK_CPNS = 'SK_CPNS';
    const SK_PNS = 'SK_PNS';
    const PENDIDIKAN = 'PENDIDIKAN';
    const BERKALA = 'BERKALA';
    const KENAIKAN_PANGKAT = 'KENAIKAN_PANGKAT';
    const SKP = 'SKP';
    const LAPORAN_REALISASI_APBDES = 'LAPORAN_REALISASI_APBDES';
    const LPJ_BUMDES = 'LPJ_BUMDES';
    const LAPORAN_DANA_DESA = 'LAPORAN_DANA_DESA';
    const ADMINISTRASI_DESA = 'ADMINISTRASI_DESA';
    const LAPORAN_ALOKASI_DANA_DESA = 'LAPORAN_ALOKASI_DANA_DESA';
    const REKAP_DATA_PM = 'REKAP_DATA_PM';
    const DISPENSIASI_NIKAH = 'DISPENSIASI_NIKAH';

    protected $table = 'file';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
<?php

namespace App\Http\Controllers;

use App\Http\Services\Administrasi\Pegawai\GetPegawaiService;
use App\Http\Services\Arsip\Kepegawaian\GetTotalArsipKepegawaianService;
use App\Http\Services\Arsip\PM\GetTotalArsipPMService;
use App\Http\Services\Arsip\PP\GetTotalArsipPP;
use App\Http\Services\SuratKeluarService;
use App\Http\Services\SuratMasukService;

class DashboardController extends Controller
{
    /**
     * Create dashboard controller instance
     * 
     */
    public function __construct()
    {
        
    }

    public function index()
    {
        $jumlah_arsip_kepegawaian = GetTotalArsipKepegawaianService::get();
        $jumlah_arsip_pm = GetTotalArsipPMService::get();
        $jumlah_arsip_pp = GetTotalArsipPP::get();
        $total_pegawai = GetPegawaiService::totalPegawai();
        $jumlah_surat_masuk = SuratMasukService::total();
        $jumlah_surat_keluar = SuratKeluarService::total();
        return view('pages.dashboard', compact('jumlah_arsip_kepegawaian', 'jumlah_arsip_pm', 'jumlah_arsip_pp', 'total_pegawai', 'jumlah_surat_masuk', 'jumlah_surat_keluar'));
    }
}
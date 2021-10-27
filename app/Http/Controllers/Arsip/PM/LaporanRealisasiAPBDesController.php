<?php

namespace App\Http\Controllers\Arsip\PM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\PM\TambahLaporanRealisasiAPBDesRequest;
use App\Http\Services\Administrasi\Desa\GetDesaService;
use App\Http\Services\Arsip\PM\TambahLaporanRealisasiAPBDesService;
use App\Models\Arsip\PM\LaporanRealisasiAPBDes;

class LaporanRealisasiAPBDesController extends Controller
{
    public function __construct()
    {
        $this->title = 'Laporan Realisasi APBDes';
    }

    public function daftarLaporanRealisasiAPBDes()
    {
        $data = LaporanRealisasiAPBDes::with('desa')->get();
        return view('pages.arsip.pm.laporan_realisasi_apbdes.index', ['data' => $data, 'title' => $this->title]);
    }

    public function tambahLaporanRealisasiAPBDes(GetDesaService $service)
    {
        $desa = $service->get();
        return view('pages.arsip.pm.laporan_realisasi_apbdes.add', ['desa' => $desa, 'title' => $this->title]);
    }

    public function simpanLaporanRealisasiAPBDes(TambahLaporanRealisasiAPBDesRequest $request, TambahLaporanRealisasiAPBDesService $service)
    {
        $id_desa = $request->input('id_desa');
        $tahun = $request->input('tahun');
        $semester = $request->input('semester');
        $anggaran = $request->input('anggaran');
        $realisasi = $request->input('realisasi');
        $file = $request->file('file');
        try {
            $service->tambah($id_desa, $tahun, $semester, $anggaran, $realisasi, $file);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
        return redirect()->route('arsip_laporan_realisasi_apbdes');
    }
}
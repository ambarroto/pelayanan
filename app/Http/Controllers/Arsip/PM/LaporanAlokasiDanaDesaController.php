<?php

namespace App\Http\Controllers\Arsip\PM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\PM\TambahLaporanAlokasiDanaDesaRequest;
use App\Http\Services\Administrasi\Desa\GetDesaService;
use App\Http\Services\Arsip\PM\TambahLaporanAlokasiDanaDesaService;
use App\Models\Arsip\PM\LaporanAlokasiDanaDesa;

class LaporanAlokasiDanaDesaController extends Controller
{
    public function __construct()
    {
        $this->title = 'Arsip Laporan Alokasi Dana Desa';
    }

    public function daftarLaporanAlokasiDanaDesa()
    {
        $data = LaporanAlokasiDanaDesa::with('desa')->get();
        return view('pages.arsip.pm.laporan_alokasi_dana_desa.index', ['data' => $data, 'title' => $this->title]);
    }

    public function tambahLaporanAlokasiDanaDesa(GetDesaService $service)
    {
        $desa = $service->get();
        return view('pages.arsip.pm.laporan_alokasi_dana_desa.add', ['desa' => $desa, 'title' => $this->title]);
    }

    public function simpanLaporanAlokasiDanaDesa(TambahLaporanAlokasiDanaDesaRequest $request, TambahLaporanAlokasiDanaDesaService $service)
    {
        $id_desa = $request->input('id_desa');
        $tahun = $request->input('tahun');
        $anggaran = $request->input('anggaran');
        $realisasi = $request->input('realisasi');
        $file = $request->file('file');
        try {
            $service->tambah($id_desa, $tahun, $anggaran, $realisasi, $file);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
        return redirect()->route('arsip_laporan_alokasi_dana_desa');
    }
}
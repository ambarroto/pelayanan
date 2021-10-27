<?php

namespace App\Http\Controllers\Arsip\PM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\PM\TambahLaporanDanaDesaRequest;
use App\Http\Services\Administrasi\Desa\GetDesaService;
use App\Http\Services\Arsip\PM\TambahLaporanDanaDesaService;
use App\Models\Arsip\PM\LaporanDanaDesa;

class LaporanDanaDesaController extends Controller
{
    public function __construct()
    {
        $this->title = 'Laporan Dana Desa';
    }

    public function daftarLaporanDanaDesa()
    {
        $data = LaporanDanaDesa::with('desa')->get();
        return view('pages.arsip.pm.laporan_dana_desa.index', ['data' => $data, 'title' => $this->title]);
    }

    public function tambahLaporanDanaDesa(GetDesaService $service)
    {
        $desa = $service->get();
        return view('pages.arsip.pm.laporan_dana_desa.add', ['desa' => $desa, 'title' => $this->title]);
    }

    public function simpanLaporanDanaDesa(TambahLaporanDanaDesaRequest $request, TambahLaporanDanaDesaService $service)
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
        return redirect()->route('arsip_laporan_dana_desa');
    }
}
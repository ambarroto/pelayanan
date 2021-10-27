<?php

namespace App\Http\Controllers\Arsip\PP;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\PP\TambahSKMRequest;
use App\Http\Services\Arsip\PP\TambahSKMService;
use App\Models\Arsip\PP\SKM;

class SKMController extends Controller
{
    public function __construct()
    {
        $this->title = 'Arsip SKM';
    }

    public function daftarArsipSKM()
    {
        $data = SKM::all();
        return view('pages.arsip.pp.skm.index', ['data' => $data, 'title' => $this->title]);
    }

    public function tambahArsipSKM()
    {
        $bulan = [ 1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
        return view('pages.arsip.pp.skm.add', ['title' => $this->title, 'bulan' => $bulan]);
    }

    public function simpanArsipSKM(TambahSKMRequest $request, TambahSKMService $service)
    {
        $layanan = $request->input('layanan');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $jumlah_koresponden = $request->input('jumlah_koresponden');
        $hasil = $request->input('hasil');
        $file = $request->file('file');
        try {
            $service->tambah($layanan, $tahun, $bulan, $jumlah_koresponden, $hasil, $file);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
        return redirect()->route('arsip_skm');
    }
}
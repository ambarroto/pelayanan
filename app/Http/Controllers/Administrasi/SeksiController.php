<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrasi\Seksi\TambahSeksiRequest;
use App\Http\Services\Administrasi\Pegawai\GetPegawaiStrukturalService;
use App\Http\Services\Seksi\TambahSeksi;
use App\Models\Administrasi\Seksi;

class SeksiController extends Controller
{
    public function __construct()
    {
        $this->title = 'Seksi / Subbag';
    }

    public function daftarSeksi()
    {
        $seksi = Seksi::with('pegawaiPejabat')->get();
        return view('pages.administrasi.seksi.index', ['seksi' => $seksi, 'title' => $this->title]);
    }

    public function tambahSeksi(GetPegawaiStrukturalService $service)
    {
        $pegawai = $service->get();
        return view('pages.administrasi.seksi.add', compact('pegawai'));
    }

    public function simpanSeksi(TambahSeksiRequest $request, TambahSeksi $service)
    {
        $nama = $request->input('nama');
        $pejabat = $request->input('pejabat');
        try {
            $service->tambah($nama, $pejabat);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('administrasi_seksi');
    }
}
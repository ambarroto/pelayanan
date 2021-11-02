<?php

namespace App\Http\Controllers\Arsip\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\Kepegawaian\TambahSKPRequest;
use App\Http\Services\Administrasi\Pegawai\GetPegawaiService;
use App\Http\Services\Arsip\Kepegawaian\TambahSKPService;
use App\Models\Arsip\Kepegawaian\SKP;

class SKPController extends Controller
{
    public function __construct()
    {
        $this->title = 'SKP';
    }

    public function daftarSKP()
    {
        $skp = SKP::with('pegawai')->get();
        return view('pages.arsip.kepegawaian.skp.index', ['skp' => $skp, 'title' => $this->title]);
    }

    public function tambahSKP(GetPegawaiService $service)
    {
        $pegawai = $service->get();
        return view('pages.arsip.kepegawaian.skp.add', compact('pegawai'));
    }

    public function simpanSKP(TambahSKPRequest $request, TambahSKPService $service)
    {
        $id_pegawai = $request->input('id_pegawai');
        $tahun = $request->input('tahun');
        $nilai = $request->input('nilai');
        $file = $request->file('file');
        try {
            $service->tambah($id_pegawai, $tahun, $nilai, $file);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('arsip_skp');
    }
}
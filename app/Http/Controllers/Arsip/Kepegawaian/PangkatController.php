<?php

namespace App\Http\Controllers\Arsip\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\Kepegawaian\TambahKenaikanPangkatRequest;
use App\Http\Services\Administrasi\Pegawai\GetPegawaiService;
use App\Http\Services\Arsip\Kepegawaian\TambahPangkatService;
use App\Models\Arsip\Kepegawaian\Pangkat;

class PangkatController extends Controller
{
    public function __construct()
    {
        $this->title = 'Pangkat';
    }

    public function daftarPangkat()
    {
        $pangkat = Pangkat::with('pegawai')->get();
        return view('pages.arsip.kepegawaian.pangkat.index', ['pangkat' => $pangkat, 'title' => $this->title]);
    }

    public function tambahPangkat(GetPegawaiService $service)
    {
        $pegawai = $service->get();
        return view('pages.arsip.kepegawaian.pangkat.add', compact('pegawai'));
    }

    public function simpanPangkat(TambahKenaikanPangkatRequest $request, TambahPangkatService $service)
    {
        $id_pegawai = $request->input('id_pegawai');
        $nama = $request->input('nama');
        $nomor_sk = $request->input('nomor_sk');
        $tanggal_sk = $request->input('tanggal_sk');
        $file = $request->file('file');
        try {
            $service->tambah($id_pegawai, $nama, $nomor_sk, $tanggal_sk, $file);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('arsip_pangkat');
    }
}
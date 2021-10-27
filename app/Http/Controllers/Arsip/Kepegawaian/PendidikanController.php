<?php

namespace App\Http\Controllers\Arsip\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\Kepegawaian\TambahPendidikanRequest;
use App\Http\Services\Administrasi\Pegawai\GetPegawaiService;
use App\Http\Services\Arsip\Kepegawaian\TambahPendidikanService;
use App\Models\Arsip\Kepegawaian\Pendidikan;

class PendidikanController extends Controller
{
    public function __construct()
    {
        $this->title = 'Pendidikan';
    }

    public function daftarPendidikan()
    {
        $pendidikan = Pendidikan::with('pegawai')->get();
        return view('pages.arsip.kepegawaian.pendidikan.index', ['pendidikan' => $pendidikan, 'title' => $this->title]);
    }

    public function tambahPendidikan(GetPegawaiService $service)
    {
        $pegawai = $service->get();
        return view('pages.arsip.kepegawaian.pendidikan.add', ['pegawai' => $pegawai]);
    }

    public function simpanPendidikan(TambahPendidikanRequest $request, TambahPendidikanService $service)
    {
        $id_pegawai = $request->input('id_pegawai');
        $nama = $request->input('nama');
        $nomor_ijazah = $request->input('nomor_ijazah');
        $ijazah = $request->file('ijazah');
        $transkrip = $request->file('transkrip');
        try {
            $service->tambah($id_pegawai, $nama, $nomor_ijazah, $ijazah, $transkrip);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('arsip_pendidikan');
    }
}
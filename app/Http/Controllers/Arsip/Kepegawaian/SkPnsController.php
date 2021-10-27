<?php

namespace App\Http\Controllers\Arsip\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\Kepegawaian\TambahSkPnsRequest;
use App\Http\Services\Administrasi\Pegawai\GetPegawaiService;
use App\Http\Services\Arsip\Kepegawaian\TambahSKPNSService;
use App\Models\Arsip\Kepegawaian\SkPns;

class SkPnsController extends Controller
{
    public function __construct()
    {
        $this->title = 'SK PNS';
    }

    public function daftarSkPns()
    {
        $sk_pns = SkPns::with('pegawai')->get();
        return view('pages.arsip.kepegawaian.sk_pns.index', ['sk_pns' => $sk_pns, 'title' => $this->title]);
    }

    public function tambahSkPns(GetPegawaiService $service)
    {
        $pegawai = $service->get();
        return view('pages.arsip.kepegawaian.sk_pns.add', compact('pegawai'));
    }

    public function simpanSkPns(TambahSkPnsRequest $request, TambahSKPNSService $service)
    {
        $id_pegawai = $request->input('id_pegawai');
        $nomor_sk = $request->input('nomor_sk');
        $tanggal_sk = $request->input('tanggal_sk');
        $file = $request->file('file');
        try {
            $service->tambah($id_pegawai, $nomor_sk, $tanggal_sk, $file);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('arsip_sk_pns');
    }
}
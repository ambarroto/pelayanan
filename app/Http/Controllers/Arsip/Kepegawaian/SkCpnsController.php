<?php

namespace App\Http\Controllers\Arsip\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\Kepegawaian\TambahSkCpnsRequest;
use App\Http\Services\Administrasi\Pegawai\GetPegawaiService;
use App\Http\Services\Arsip\Kepegawaian\TambahSKCPNSService;
use App\Models\Arsip\Kepegawaian\SkCpns;

class SkCpnsController extends Controller
{
    public function __construct()
    {
        $this->title = 'SK CPNS';
    }

    public function daftarSkCpns()
    {
        $sk_cpns = SkCpns::with('pegawai')->get();
        return view('pages.arsip.kepegawaian.sk_cpns.index', ['sk_cpns' => $sk_cpns, 'title' => $this->title]);
    }

    public function tambahSkCpns(GetPegawaiService $service)
    {
        $pegawai = $service->get();
        return view('pages.arsip.kepegawaian.sk_cpns.add', compact('pegawai'));
    }

    public function simpanSkCpns(TambahSkCpnsRequest $request, TambahSKCPNSService $service)
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
        return redirect()->route('arsip_sk_cpns');
    }
}
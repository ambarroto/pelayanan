<?php

namespace App\Http\Controllers\Arsip\PP;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\PP\TambahPelayananKTPRequest;
use App\Http\Services\Arsip\PP\TambahPelayananKTPService;
use App\Models\Arsip\PP\PelayananKTP;

class PelayananKTPController extends Controller
{
    public function __construct()
    {
        $this->title = 'Arsip Pelayanan KTP';
    }

    public function daftarPelayananKTP()
    {
        $data = PelayananKTP::all();
        return view('pages.arsip.pp.pelayanan_ktp.index', ['data' => $data, 'title' => $this->title]);
    }

    public function tambahPelayananKTP()
    {
        return view('pages.arsip.pp.pelayanan_ktp.add', ['title' => $this->title]);
    }

    public function simpanPelayananKTP(TambahPelayananKTPRequest $request, TambahPelayananKTPService $service)
    {
        $nomor_kk = $request->input('nomor_kk');
        $nomor_nik_ktp = $request->input('nomor_nik_ktp');
        $nama = $request->input('nama');
        $file = $request->file('file');
        try {
            $service->tambah($nomor_kk, $nomor_nik_ktp, $nama, $file);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
        return redirect()->route('arsip_pelayanan_ktp');
    }
}
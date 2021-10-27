<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrasi\Pegawai\TambahPegawaiRequest;
use App\Http\Services\Administrasi\Pegawai\TambahPegawai;
use App\Models\Administrasi\Pegawai;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->title = 'Pegawai';
    }

    public function daftarPegawai()
    {
        $pegawai = Pegawai::all();
        $title = $this->title;
        return view('pages.administrasi.pegawai.index', compact('pegawai', 'title'));
    }

    public function tambahPegawai()
    {
        return view('pages.administrasi.pegawai.add');
    }
    
    public function simpanPegawai(TambahPegawaiRequest $request, TambahPegawai $tambahPegawai)
    {
        $nip = $request->input('nip');
        $nama = $request->input('nama');
        $gelar_depan = $request->input('gelar_depan');
        $gelar_belakang = $request->input('gelar_belakang');
        $no_hp = $request->input('no_hp');
        try {
            $tambahPegawai->tambah($nip, $nama, $gelar_depan, $gelar_belakang, $no_hp);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('administrasi_pegawai');
    }
}
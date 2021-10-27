<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrasi\Desa\TambahDesaRequest;
use App\Http\Services\Administrasi\Desa\TambahDesa;
use App\Models\Administrasi\Desa;

class DesaController extends Controller
{
    public function __construct()
    {
        $this->title = 'Desa';
    }

    public function daftarDesa()
    {
        $desa = Desa::all();
        return view('pages.administrasi.desa.index', ['desa' => $desa, 'title' => $this->title]);
    }

    public function tambahDesa()
    {
        return view('pages.administrasi.desa.add');
    }

    public function simpanDesa(TambahDesaRequest $request, TambahDesa $tambahDesa)
    {
        $kode = $request->input('kode');
        $nama = $request->input('nama');
        try {
            $tambahDesa->tambah($kode, $nama);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('administrasi_desa');
    }
}
<?php

namespace App\Http\Controllers\Arsip\PM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\PM\TambahAdministrasiDesaRequest;
use App\Http\Services\Administrasi\Desa\GetDesaService;
use App\Http\Services\Arsip\PM\TambahAdministrasiDesaService;
use App\Models\Arsip\PM\AdministrasiDesa;

class AdministrasiDesaController extends Controller
{
    public function __construct()
    {
        $this->title = 'Arsip Administrasi Desa';
    }

    public function daftarAdministrasiDesa()
    {
        $data = AdministrasiDesa::with('desa')->get();
        return view('pages.arsip.pm.administrasi_desa.index', ['data' => $data, 'title' => $this->title]);
    }

    public function tambahAdministrasiDesa(GetDesaService $service)
    {
        $desa = $service->get();
        return view('pages.arsip.pm.administrasi_desa.add', ['desa' => $desa, 'title' => $this->title]);
    }

    public function simpanAdministrasiDesa(TambahAdministrasiDesaRequest $request, TambahAdministrasiDesaService $service)
    {
        $id_desa = $request->input('id_desa');
        $tahun = $request->input('tahun');
        $nama = $request->input('nama');
        $peruntukan = $request->input('peruntukan');
        $file = $request->file('file');
        try {
            $service->tambah($id_desa, $nama, $tahun, $peruntukan, $file);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
        return redirect()->route('arsip_administrasi_desa');
    }
}
<?php

namespace App\Http\Controllers\Arsip\PM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\PM\TambahLPJBumdesRequest;
use App\Http\Services\Administrasi\Desa\GetDesaService;
use App\Http\Services\Arsip\PM\TambahLPJBumdesService;
use App\Models\Arsip\PM\LPJBumdes;

class LPJBumdesController extends Controller
{
    public function __construct()
    {
        $this->title = 'LPJ Bumdes';
    }

    public function daftarLPJBumdes()
    {
        $data = LPJBumdes::with('desa')->get();
        return view('pages.arsip.pm.lpj_bumdes.index', ['data' => $data, 'title' => $this->title]);
    }

    public function tambahLPJBumdes(GetDesaService $service)
    {
        $desa = $service->get();
        return view('pages.arsip.pm.lpj_bumdes.add', ['desa' => $desa, 'title' => $this->title]);
    }

    public function simpanLPJBumdes(TambahLPJBumdesRequest $request, TambahLPJBumdesService $service)
    {
        $id_desa = $request->input('id_desa');
        $tahun = $request->input('tahun');
        $nama = $request->input('nama');
        $file = $request->file('file');
        try {
            $service->tambah($id_desa, $nama, $tahun, $file);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
        return redirect()->route('arsip_lpj_bumdes');
    }
}
<?php

namespace App\Http\Controllers\Arsip\PM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arsip\PM\TambahRekapDataRequest;
use App\Http\Services\Arsip\PM\TambahRekapDataService;
use App\Models\Arsip\PM\RekapData;

class RekapDataController extends Controller
{
    public function __construct()
    {
        $this->title = 'Arsip Rekap Data';
    }

    public function daftarRekapData()
    {
        $data = RekapData::all();
        return view('pages.arsip.pm.rekap_data.index', ['data' => $data, 'title' => $this->title]);
    }

    public function tambahRekapData()
    {
        return view('pages.arsip.pm.rekap_data.add', ['title' => $this->title]);
    }

    public function simpanRekapData(TambahRekapDataRequest $request, TambahRekapDataService $service)
    {
        $nama = $request->input('nama');
        $file = $request->file('file');
        try {
            $service->tambah($nama, $file);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
        return redirect()->route('arsip_rekap_data');
    }
}
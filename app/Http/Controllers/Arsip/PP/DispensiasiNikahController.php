<?php

namespace App\Http\Controllers\Arsip\PP;

use App\Http\Controllers\Controller;
use App\Models\Arsip\PP\DispensiasiNikah;
use App\Http\Requests\Arsip\PP\TambahDispensiasiNikahRequest;
use App\Http\Services\Arsip\PP\TambahDispensiasiNikahService;

class DispensiasiNikahController extends Controller
{
    public function __construct()
    {
        $this->title = 'Arsip Dispensiasi Nikah';
    }

    public function daftarDispensiasiNikah()
    {
        $data = DispensiasiNikah::all();
        return view('pages.arsip.pp.dispensiasi_nikah.index', ['data' => $data, 'title' => $this->title]);
    }

    public function tambahDispensiasiNikah()
    {
        return view('pages.arsip.pp.dispensiasi_nikah.add', ['title' => $this->title]);
    }

    public function simpanDispensiasiNikah(TambahDispensiasiNikahRequest $request, TambahDispensiasiNikahService $service)
    {
        $nomor = $request->input('nomor');
        $tanggal = $request->input('tanggal');
        $file = $request->file('file');
        try {
            $service->tambah($nomor, $tanggal, $file);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
        return redirect()->route('arsip_dispensiasi_nikah');
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputDispensiasiNikahRequest;
use App\Http\Services\DispensiasiNikahService;
use App\Http\Services\InputDispensiasiNikahService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DispensiasiNikahController extends Controller
{
    /**
     * Create DispensiasiNikahController instance
     * 
     */
    public function __construct()
    {
        $this->title = 'Dispensiasi Nikah';
    }

    /**
     * Menampilkan seluruh data permohonan dispensiasi nikah
     * 
     * @param \App\Http\Services\DispensiasiNikahService $service
     * @return \Illuminate\View\View
     */
    public function index(DispensiasiNikahService $service): View
    {
        $title = $this->title;
        $items = $service->getAll();
        return view('pages.dispensiasi_nikah.index', compact('title', 'items'));
    }

    /**
     * Halaman tambah dispensiasi_nikah
     * 
     * @return \Illuminate\View\View
     */
    public function tambah(): View
    {
        $title = "Tambah $this->title";
        return view('pages.dispensiasi_nikah.add', compact('title'));
    }

    /**
     * Tambah data dispensiasi nikah
     * 
     * @param \App\Http\Requests\InputDispensiasiNikahRequest $request
     * @param \App\Http\Services\InputDispensiasiNikahService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function input(InputDispensiasiNikahRequest $request, InputDispensiasiNikahService $service): RedirectResponse
    {
        $nama = $request->nama;
        $tempat_lahir = $request->tempat_lahir;
        $tanggal_lahir = $request->tanggal_lahir;
        $alamat = $request->alamat;
        $pekerjaan = $request->pekerjaan;
        $keterangan = $request->keterangan;
        try {
            $service->input($nama, $tempat_lahir, $tanggal_lahir, $pekerjaan, $alamat, $keterangan);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage()); 
        }
        return redirect()->route('dispensiasi_nikah');
    }
}
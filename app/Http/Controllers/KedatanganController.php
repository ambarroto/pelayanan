<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputKedatanganRequest;
use App\Http\Services\InputKedatanganService;
use App\Http\Services\KedatanganService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KedatanganController extends Controller
{
    /**
     * Create KedatanganController instance
     * 
     */
    public function __construct()
    {
        $this->title = 'Kedatangan Penduduk';
    }

    /**
     * Ambil semua data kedatangan penduduk
     * 
     * @param \App\Http\Services\KedatanganService $service
     * @return \Illuminate\View\View
     */
    public function index(KedatanganService $service): View
    {
        $title = $this->title;
        $items = $service->getAll();
        return view('pages.kedatangan.index', compact('items', 'title'));
    }

    /**
     * halaman tambah kedatangan penduduk
     * 
     * @return \Illuminate\View\View
     */
    public function tambah(): View
    {
        $title = "Tambah $this->title";
        return view('pages.kedatangan.add', compact('title'));
    }

    /**
     * Tambah data kedatangan penduduk
     * 
     * @param \App\Http\Requests\InputKedatanganRequest $request
     * @param \App\Http\Services\InputKedatanganService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function input(InputKedatanganRequest $request, InputKedatanganService $service): RedirectResponse
    {
        $nama = $request->input('nama');
        $tempat_lahir = $request->input('tempat_lahir');
        $tanggal_lahir = $request->input('tanggal_lahir');
        $asal_desa = $request->input('asal_desa');
        $asal_kecamatan = $request->input('asal_kecamatan');
        $asal_kabupaten = !empty($request->input('asal_kabupaten')) ? $request->input('asal_kabupaten'): null;
        $tujuan_desa = $request->input('tujuan_desa');
        $jumlah_keluarga = !empty($request->input('jumlah_keluarga')) ? $request->input('jumlah_keluarga'): 0;
        try {
            $service->input($nama, $tempat_lahir, $tanggal_lahir, $asal_desa, $asal_kecamatan, $asal_kabupaten, $tujuan_desa, $jumlah_keluarga);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage()); 
        }
        return redirect()->route('kedatangan');
    }
}
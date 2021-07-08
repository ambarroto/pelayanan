<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputSuratKeteranganRequest;
use App\Http\Services\InputSuratKeteranganService;
use App\Http\Services\SuratKeteranganService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SuratKeteranganController extends Controller
{
    /**
     * Create SuratKeteranganController instance
     * 
     */
    public function __construct()
    {
        $this->title = 'Surat Keterangan';
    }

    /**
     * Menampilkan seluruh data surat keterangan
     * 
     * @param \App\Http\Services\SuratKeteranganService $service
     * @return \Illuminate\View\View
     */
    public function index(SuratKeteranganService $service): View
    {
        $title = $this->title;
        $items = $service->getAll();
        return view('pages.surat_keterangan.index', compact("title", 'items'));
    }

    /**
     * Halaman tambah surat keterangan baru
     * 
     * @return \Illuminate\View\View
     */
    public function tambah(): View
    {
        return view('pages.surat_keterangan.add');
    }

    /**
     * Input data surat keterangan baru
     * 
     * @param \App\Http\Requests\InputSuratKeteranganRequest $request
     * @param \App\Http\Services\InputSuratKeteranganService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function input(InputSuratKeteranganRequest $request, InputSuratKeteranganService $service): RedirectResponse
    {
        $nama = $request->input('nama');
        $tempat_lahir = $request->input('tempat_lahir');
        $tanggal_lahir = $request->input('tanggal_lahir');
        $alamat = $request->input('alamat');
        $pekerjaan = $request->input('pekerjaan');
        $keterangan = $request->input('keterangan');
        try {
            $service->input($nama, $tempat_lahir, $tanggal_lahir, $alamat, $pekerjaan, $keterangan);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('surat_keterangan');
    }
}
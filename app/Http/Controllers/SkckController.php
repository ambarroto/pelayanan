<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputSkckRequest;
use App\Http\Services\InputSkckService;
use App\Http\Services\SkckService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SkckController extends Controller
{
    /**
     * Create SkckController instance
     * 
     */
    public function __construct()
    {
        $this->title = 'SKCK';
    }

    /**
     * Ambil semua data pengantar SKCK
     * 
     * @param \App\Http\Services\SkckService $service
     * @return \Illuminate\View\View
     */
    public function index(SkckService $service): View
    {
        $skck = $service->getAll();
        $title = $this->title;
        return view('pages.skck.index', compact('skck', 'title'));
    }

    /**
     * halaman tambah pengantar SKCK
     * 
     * @return \Illuminate\View\View
     */
    public function tambah(): View
    {
        $title = "Tambah $this->title";
        return view('pages.skck.add', compact('title'));
    }

    /**
     * Tambah pengantar skck baru
     * 
     * @param \App\Http\Requests\InputSkckRequest $request
     * @param \App\Http\Services\InputSkckService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function input(InputSkckRequest $request, InputSkckService $service): RedirectResponse
    {
        $nama = $request->input('nama');
        $tempat_lahir = $request->input('tempat_lahir');
        $tanggal_lahir = $request->input('tanggal_lahir');
        $alamat = $request->input('alamat');
        $agama = $request->input('agama');
        $pendidikan = $request->input('pendidikan');
        $pekerjaan = $request->input('pekerjaan');
        $nomor_surat_dari_desa = $request->input('nomor_surat_dari_desa');
        $status = $request->input('status');
        $nik = $request->input('nik');
        $keperluan = $request->input('keperluan');
        $foto = $request->file('foto');
        try {
            $service->input($nama, $tempat_lahir, $tanggal_lahir, $alamat, $agama, $pendidikan, $pekerjaan, $nomor_surat_dari_desa, $status, $nik, $keperluan, $foto);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage()); 
        }
        return redirect()->route('skck');
    }
}
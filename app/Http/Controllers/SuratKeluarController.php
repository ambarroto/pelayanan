<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputSuratKeluarRequest;
use App\Http\Services\InputSuratKeluarService;
use App\Http\Services\SuratKeluarService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SuratKeluarController extends Controller
{
    /**
     * Create SuratKeluarController instance
     * 
     */
    public function __construct()
    {
        $this->title = 'Surat Keluar';
    }

    /**
     * Daftar surat keluar
     * 
     * @param \App\Http\Services\SuratKeluarService $service
     * @return \Illuminate\View\View
     */
    public function index(SuratKeluarService $service): View
    {
        $surat_keluar = $service->getAll();
        $title = $this->title;
        return view('pages.surat_keluar.index', compact('surat_keluar', 'title'));
    }

    /**
     * Tambah surat keluar
     * 
     * @return \Illuminate\View\View
     */
    public function tambah(): View
    {
        $title = "Tambah $this->title";
        return view('pages.surat_keluar.add', compact('title'));
    }

    /**
     * Tambah surat keluar baru
     * 
     * @param \App\Http\Requests\InputSuratKeluarRequest $request
     * @param \App\Http\Services\InputSuraKeluarService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function input(InputSuratKeluarRequest $request, InputSuratKeluarService $service): RedirectResponse
    {
        $nomor_surat = $request->input('nomor_surat');
        $alamat_tujuan = $request->input('alamat_tujuan');
        $perihal = $request->input('perihal');
        $penunjuk = $request->input('penunjuk');
        $tanggal = $request->input('tanggal_surat');
        $lampiran = $request->file('lampiran') ?: [];
        try {
            $service->input($nomor_surat, $alamat_tujuan, $perihal, $penunjuk, $tanggal, $lampiran);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('surat_keluar');
    }

    /**
     * Lihat detil surat keluar
     * 
     * @param int $id
     * @return mixed
     */
    public function view(int $id)
    {
        $title = "Detil $this->title";
        return view('pages.surat_keluar.detail', compact('surat_keluar', 'title'));
    }
}
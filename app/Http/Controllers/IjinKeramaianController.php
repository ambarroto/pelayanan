<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputIjinKeramaianRequest;
use App\Http\Services\IjinKeramaianService;
use App\Http\Services\InputIjinKeramaianService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IjinKeramaianController extends Controller
{
    /**
     * Create IjinKeramaianController instance
     * 
     */
    public function __construct()
    {
        $this->title = 'Ijin Keramaian';
    }

    /**
     * Menampilkan semua data ijin keramaian
     * 
     * @param \App\Http\Services\IjinKeramaianService $service
     * @return \Illuminate\View\View
     */
    public function index(IjinKeramaianService $service): View
    {
        $title = $this->title;
        $items = $service->getAll();
        return view('pages.ijin_keramaian.index', compact('items', 'title'));
    }

    /**
     * Halaman tambah ijin keramaian
     * 
     * @return \Illuminate\View\View
     */
    public function tambah(): View
    {
        $title = "Tambah $this->title";
        return view('pages.ijin_keramaian.add', compact('title'));
    }

    /**
     * Tambah data ijin keramaian
     * 
     * @param \App\Http\Requests\InputIjinKeramaianRequest $request
     * @param \App\Http\Services\InputIjinKeramaianService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function input(InputIjinKeramaianRequest $request, InputIjinKeramaianService $service): RedirectResponse
    {
        $nama = $request->input('nama');
        $umur = !empty($request->input('umur')) ? $request->input('umur') : null;
        $agama = $request->input('agama');
        $alamat = $request->input('alamat');
        $pekerjaan = $request->input('pekerjaan');
        $hajat = $request->input('hajat');
        $jumlah_undangan = !empty($request->input('jumlah_undangan')) ? $request->input('jumlah_undangan') : null;
        $macam_hiburan = !empty($request->input('macam_hiburan')) ? $request->input('macam_hiburan') : null;
        $tanggal_keramaian = $request->input('tanggal_keramaian');
        try {
            $service->input($nama, $umur, $agama, $alamat, $pekerjaan, $hajat, $jumlah_undangan, $macam_hiburan, $tanggal_keramaian);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage()); 
        }
        return redirect()->route('ijin_keramaian');
    }
}
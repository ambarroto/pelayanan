<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputImbRequest;
use App\Http\Services\ImbService;
use App\Http\Services\InputImbService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ImbController extends Controller
{
    /**
     * Create ImbController instance
     * 
     */
    public function __construct()
    {
        $this->title = 'IMB';
    }

    /**
     * Menampilkan seluruh data IMB
     * 
     * @param \App\Http\Services\ImbService $service
     * @return \Illuminate\View\View
     */
    public function index(ImbService $service): View
    {
        $imb = $service->getAll();
        $title = $this->title;
        return view('pages.imb.index', compact('imb', 'title'));
    }

    /**
     * Halaman menambah data IMB
     * 
     * @return \Illuminate\View\View
     */
    public function tambah(): View
    {
        $title = "Tambah $this->title";
        return view('pages.imb.add', compact('title'));
    }

    /**
     * Tambah data IMB
     * 
     * @param \App\Http\Requests\InputImbRequest $request
     * @param \App\Http\Services\InputImbService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function input(InputImbRequest $request, InputImbService $service): RedirectResponse
    {
        $nama = $request->input('nama');
        $tempat_lahir = $request->input('tempat_lahir');
        $tanggal_lahir = $request->input('tanggal_lahir');
        $alamat = $request->input('alamat');
        $pekerjaan = $request->input('pekerjaan');
        $keterangan = $request->input('keterangan');
        $nomor_hp = !empty($request->input('nomor_hp')) ? $request->input('nomor_hp'): null;
        try {
            $service->input($nama, $tempat_lahir, $tanggal_lahir, $alamat, $pekerjaan, $keterangan, $nomor_hp);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('imb');
    }
}
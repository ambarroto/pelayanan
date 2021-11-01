<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputSuratMasukRequest;
use App\Http\Requests\UpdateSuratMasukRequest;
use App\Http\Services\InputSuratMasukService;
use Illuminate\View\View;
use App\Http\Services\SuratMasukService;
use App\Http\Services\UpdateSuratMasukService;
use Dompdf\Dompdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\PdfToImage\Pdf;

class SuratMasukController extends Controller
{
    /**
     * Create SuratMasukController instance
     * 
     */
    public function __construct()
    {
        $this->title = 'Surat Masuk';
    }

    /**
     * Daftar surat masuk
     * 
     * @param \App\Http\Services\SuratMasukService $service
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(SuratMasukService $service, Request $request): View
    {
        $surat_masuk = $service->getAll($request);
        $title = $this->title;
        return view('pages.surat_masuk.index', compact('surat_masuk', 'title'));
    }

    /**
     * Tambah surat masuk
     * 
     * @return \Illuminate\View\View
     */
    public function tambah(): View
    {
        $title = "Tambah $this->title";
        return view('pages.surat_masuk.add', compact('title'));
    }

    /**
     * Tambah surat masuk baru
     * 
     * @param \App\Http\Requests\InputSuratMasukRequest $request
     * @param \App\Http\Services\InputSuratMasukService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function input(InputSuratMasukRequest $request, InputSuratMasukService $service): RedirectResponse
    {
        $nomor_surat = $request->input('nomor_surat');
        $alamat_surat = $request->input('alamat_surat');
        $tanggal_surat = $request->input('tanggal_surat');
        $perihal = $request->input('perihal');
        $lampiran = $request->file('lampiran') ?: [];
        try {
            $service->input($nomor_surat, $alamat_surat, $tanggal_surat, $perihal, $lampiran);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('surat_masuk');
    }

    /**
     * Lihat detil surat masuk
     * 
     * @param int $id
     * @param \App\Http\Services\SuratMasukService $service
     * @return mixed
     */
    public function view(int $id, SuratMasukService $service)
    {
        $surat_masuk = $service->detil($id);
        $title = "Detil $this->title";
        return view('pages.surat_masuk.detail', compact('surat_masuk', 'title'));
    }

    /**
     * Halaman edit surat masuk
     * 
     * @param int $id
     * @param \App\Http\Services\SuratMasukService $service
     * @return mixed
     */
    public function edit(int $id, SuratMasukService $service)
    {
        $surat_masuk = $service->detil($id);
        $title = "Edit $this->title";
        return view('pages.surat_masuk.edit', compact('surat_masuk', 'title'));
    }

    /**
     * Ubah data surat masuk
     * 
     * @param int $id
     * @param \App\Http\Requests\UpdateSuratMasukRequest $request
     * @param \App\Http\Services\UpdateSuratMasukService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, UpdateSuratMasukRequest $request, UpdateSuratMasukService $service): RedirectResponse
    {
        $isi_disposisi = $request->isi_disposisi;
        try {
            $service->update($id, $isi_disposisi);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
        return redirect()->route('surat_masuk');
    }

    /**
     * export data surat masuk
     * 
     * @return mixed
     */
    public function exportPdf(SuratMasukService $service)
    {
        $id = request()->input('id');
        if ($id) {
            $ids = explode(',', $id);
            $data = $service->getByIds($ids);
            // return response()->json($data);
            // return view('pages.surat_masuk.export', compact('data'));
            $pdf = new Dompdf();
            $pdf->getOptions()->setChroot(public_path());
            $pdf->loadHtml(view('pages.surat_masuk.export', compact('data')));
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();
            return $pdf->stream();
        }
        return redirect()->back();
    }
}
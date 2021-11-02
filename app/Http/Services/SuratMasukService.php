<?php

namespace App\Http\Services;

use App\Http\Resources\SuratMasukResource;
use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuratMasukService
{
    /**
     * Total surat masuk
     * 
     * @return mixed
     */
    public static function total()
    {
        return SuratMasuk::count();
    }

    /**
     * Get all surat masuk
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getAll(Request $request): JsonResource
    {
        $tanggal_awal = null;
        $tanggal_akhir = null;
        if ($request->has('tanggal_surat')) {
            $tanggal_surat = explode('-', $request->get('tanggal_surat'));
            try {
                $tanggal_awal = Carbon::createFromFormat('d/m/Y', trim($tanggal_surat[0]))->format('Y-m-d');
            } catch (\Throwable $th) {
                $tanggal_awal = null;
            }
            try {
                $tanggal_akhir = Carbon::createFromFormat('d/m/Y', trim($tanggal_surat[1]))->format('Y-m-d');
            } catch (\Throwable $th) {
                $tanggal_akhir = null;
            }
        }
        $surat_masuk = SuratMasuk::orderBy('nomor', 'DESC');
        if ($request->has('nomor_surat') && $request->get('nomor_surat') != null) {
            $surat_masuk = $surat_masuk->where('nomor_surat', $request->get('nomor_surat'));
        }
        if ($request->has('alamat_surat') && $request->get('alamat_surat') != null) {
            $alamat_surat = $request->get('alamat_surat');
            $surat_masuk = $surat_masuk->where('alamat_surat', 'like', "%$alamat_surat%");
        }
        if ($tanggal_awal != null) {
            $surat_masuk = $surat_masuk->whereDate('tanggal_surat', '>=', $tanggal_awal);
        }
        if ($tanggal_akhir != null) {
            $surat_masuk = $surat_masuk->whereDate('tanggal_surat', '<=', $tanggal_akhir);
        }
        $surat_masuk = $surat_masuk->get();
        $surat_masuk = SuratMasukResource::collection($surat_masuk);
        return $surat_masuk;
    }

    /**
     * Ambil detil surat masuk
     * 
     * @param int $id
     * @return \App\Models\SuratMasuk
     */
    public function detil(int $id): SuratMasuk
    {
        $surat_masuk = SuratMasuk::with('fileSuratMasuk')->find($id);
        if (empty($surat_masuk)) throw new ModelNotFoundException("Surat masuk tidak ditemukan.");
        return $surat_masuk;
    }

    /**
     * Ambil surat masuk berdasar daftar id
     * 
     * @param array $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getByIds(array $id = []): JsonResource
    {
        $surat_masuk = SuratMasuk::whereIn('id', $id)->orderBy('nomor', 'DESC')->get();
        $surat_masuk = SuratMasukResource::collection($surat_masuk);
        return $surat_masuk;
    }
}
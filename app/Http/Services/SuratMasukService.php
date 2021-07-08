<?php

namespace App\Http\Services;

use App\Http\Resources\SuratMasukResource;
use App\Models\SuratMasuk;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\JsonResource;

class SuratMasukService
{
    /**
     * Get all surat masuk
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getAll(): JsonResource
    {
        $surat_masuk = SuratMasuk::orderBy('nomor', 'DESC')->get();
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
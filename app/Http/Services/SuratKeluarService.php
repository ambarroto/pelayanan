<?php

namespace App\Http\Services;

use App\Http\Resources\SuratKeluarResource;
use App\Models\SuratKeluar;
use Illuminate\Http\Resources\Json\JsonResource;

class SuratKeluarService
{
    /**
     * Ambil semua data surat keluar
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getAll(): JsonResource
    {
        $surat_keluar = SuratKeluar::orderBy('nomor', 'DESC')->get();
        return SuratKeluarResource::collection($surat_keluar);
    }
}
<?php

namespace App\Http\Services;

use App\Http\Resources\SuratKeteranganResource;
use App\Models\SuratKeterangan;
use Illuminate\Http\Resources\Json\JsonResource;

class SuratKeteranganService
{
    /**
     * Mengambil semua data surat keterangan
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getAll(): JsonResource
    {
        return SuratKeteranganResource::collection(SuratKeterangan::get());
    }
}
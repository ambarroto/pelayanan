<?php

namespace App\Http\Services;

use App\Http\Resources\KedatanganResource;
use App\Models\Kedatangan;
use Illuminate\Http\Resources\Json\JsonResource;

class KedatanganService
{
    /**
     * Mengambil semua data kedatangan penduduk
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getAll(): JsonResource
    {
        return KedatanganResource::collection(Kedatangan::get());
    }
}
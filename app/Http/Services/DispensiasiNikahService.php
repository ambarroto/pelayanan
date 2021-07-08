<?php

namespace App\Http\Services;

use App\Http\Resources\DispensiasiNikahResource;
use App\Models\DispensiasiNikah;
use Illuminate\Http\Resources\Json\JsonResource;

class DispensiasiNikahService
{
    /**
     * Mengambil semua data dispensiasi nikah
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getAll(): JsonResource
    {
        return DispensiasiNikahResource::collection(DispensiasiNikah::get());
    }
}
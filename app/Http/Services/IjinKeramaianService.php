<?php

namespace App\Http\Services;

use App\Http\Resources\IjinKeramaianResource;
use App\Models\IjinKeramaian;
use Illuminate\Http\Resources\Json\JsonResource;

class IjinKeramaianService
{
    /**
     * Ambil semua data ijin keramaian
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getAll(): JsonResource
    {
        return IjinKeramaianResource::collection(IjinKeramaian::get());
    }
}
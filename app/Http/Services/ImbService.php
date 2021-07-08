<?php

namespace App\Http\Services;

use App\Http\Resources\ImbResource;
use App\Models\Imb;
use Illuminate\Http\Resources\Json\JsonResource;

class ImbService
{
    /**
     * Mengambil semua data IMB
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getAll(): JsonResource
    {
        return ImbResource::collection(Imb::get());
    }
}
<?php

namespace App\Http\Services;

use App\Http\Resources\SkckResource;
use App\Models\Skck;
use Illuminate\Http\Resources\Json\JsonResource;

class SkckService
{
    /**
     * Ambil semua data pengantar SKCK
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getAll(): JsonResource
    {
        $skck = Skck::with('fileSkck')->get();
        return SkckResource::collection($skck);
    }
}
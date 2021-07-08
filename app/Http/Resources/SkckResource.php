<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SkckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array(
            'id' => $this->id,
            'nomor' => $this->nomor,
            'tanggal' => $this->tanggal,
            'nama' => $this->nama,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'agama' => $this->agama,
            'pendidikan' => $this->pendidikan,
            'pekerjaan' => $this->pekerjaan,
            'nomor_surat_dari_desa' => $this->nomor_surat_dari_desa,
            'status' => $this->status,
            'nik' => $this->nik,
            'keperluan' => $this->keperluan,
        );
    }
}

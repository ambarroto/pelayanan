<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class KedatanganResource extends JsonResource
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
            'asal_desa' => $this->asal_desa,
            'asal_kecamatan' => $this->asal_kecamatan,
            'asal_kabupaten' => $this->asal_kabupaten,
            'asal_provinsi' => $this->asal_provinsi,
            'tujuan_desa' => $this->tujuan_desa,
            'jumlah_keluarga' => !empty($this->jumlah_keluarga),
        );
    }
}

<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SuratMasukResource extends JsonResource
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
            'tanggal_terima' => Carbon::parse($this->tanggal_terima)->format('d-m-Y'),
            'alamat_surat' => $this->alamat_surat,
            'tanggal_surat' => Carbon::parse($this->tanggal_surat)->format('d-m-Y'),
            'nomor_surat' => $this->nomor_surat,
            'perihal_surat' => $this->perihal_surat
        );
    }
}

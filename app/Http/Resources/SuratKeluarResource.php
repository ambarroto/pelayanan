<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SuratKeluarResource extends JsonResource
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
            'nomor_surat' => $this->nomor_surat,
            'alamat_tujuan' => $this->alamat_tujuan,
            'tanggal' => Carbon::parse($this->tanggal_surat)->format('d-m-Y'),
            'uraian' => $this->uraian,
            'penunjuk' => $this->penunjuk
        );
    }
}

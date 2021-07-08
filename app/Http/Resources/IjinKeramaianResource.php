<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IjinKeramaianResource extends JsonResource
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
            'umur' => $this->umur,
            'agama' => $this->agama,
            'alamat' => $this->alamat,
            'pekerjaan' => $this->pekerjaan,
            'hajat' => $this->hajat,
            'jumlah_undangan' => $this->jumlah_undangan,
            'macam_hiburan' => $this->macam_hiburan,
            'tanggal_keramaian' => $this->tanggal_keramaian,
            'status' => $this->status
        );
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Kedatangan extends Model
{
    protected $table = 'kedatangan';

    protected $guarded = ['id'];

    public function getFormatTanggalAttribute()
    {
        return Carbon::parse($this->tanggal)->format('d-m-Y');
    }

    public function getNamaTtlAttribute()
    {
        $tanggal_lahir = Carbon::parse($this->tanggal_lahir)->format('d-m-Y');
        return "$this->nama / <br> $this->tempat_lahir, $tanggal_lahir";
    }

    public function getAsalAttribute()
    {
        $asal = "Ds. $this->asal_desa <br> Kec. $this->asal_kecamatan";
        if (!empty($this->asal_kabupaten)) $asal = "$asal <br> Kab. $this->asal_kabupaten";
        return $asal;
    }

    public function getTujuanAttribute()
    {
        $nama_opd = config('app.nama_opd');
        return "Ds. $this->tujuan_desa <br> $nama_opd";
    }
}
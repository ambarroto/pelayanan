<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Skck extends Model
{
    protected $table = 'skck';

    protected $guarded = ['id'];

    public function getFormatTanggalAttribute()
    {
        return tanggal_indonesia($this->tanggal);
    }

    public function getNamaTtlAlamatAttribute()
    {
        $tanggal_lahir = tanggal_indonesia($this->tanggal_lahir);
        return "$this->nama / <br> $this->tempat_lahir, $tanggal_lahir / <br> $this->alamat";
    }

    public function getAgamaPendidikanPekerjaanAttribute()
    {
        return "$this->agama / <br> $this->pendidikan / <br> $this->pekerjaan";
    }

    public function fileSkck()
    {
        return $this->hasOne(FileSkck::class, 'id_skck');
    }
}
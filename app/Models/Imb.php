<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Imb extends Model
{
    const STATUS_ACTIVE = 1;

    protected $table = 'imb';

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
}
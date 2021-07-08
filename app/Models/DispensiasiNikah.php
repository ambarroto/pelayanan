<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DispensiasiNikah extends Model
{
    const STATUS_SUCCESS = 2;
    const STATUS_FAILED = 3;

    protected $table = 'dispensiasi_nikah';

    protected $guarded = ['id'];

    public function getTtlAttribute()
    {
        $tanggal_lahir = tanggal_indonesia($this->tanggal_lahir);
        return "$this->tempat_lahir / $tanggal_lahir";
    }
}
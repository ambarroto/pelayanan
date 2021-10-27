<?php

namespace App\Models\Administrasi;

use App\Models\Arsip\PM\LaporanRealisasiAPBDes;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = 'desa';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function laporanRealisasiAPBDes()
    {
        return $this->hasMany(LaporanRealisasiAPBDes::class, 'id_desa');
    }
}
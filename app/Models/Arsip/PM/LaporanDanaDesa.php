<?php

namespace App\Models\Arsip\PM;

use App\Models\Administrasi\Desa;
use App\Models\Arsip\File;
use Illuminate\Database\Eloquent\Model;

class LaporanDanaDesa extends Model
{
    protected $table = 'pm_laporan_dana_desa';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    public function file()
    {
        return $this->hasOne(File::class, 'id_arsip');
    }
}
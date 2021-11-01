<?php

namespace App\Models\Arsip\PM;

use App\Models\Administrasi\Desa;
use App\Models\Arsip\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getFileLocationAttribute()
    {
        $file = $this->file()->whereJenisArsip(File::LAPORAN_DANA_DESA)->first();
        if ($file) {
            $lokasi = $file->lokasi;
            $filename = $file->nama_file;
            $lokasi_file = $lokasi . DIRECTORY_SEPARATOR . $filename;
            if (Storage::exists($lokasi_file)) {
                return asset($lokasi_file);
            }
            return 0;
        }
        return 0;
    }
}
<?php

namespace App\Models\Arsip\Kepegawaian;

use App\Models\Administrasi\Pegawai;
use App\Models\Arsip\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SkCpns extends Model
{
    protected $table = 'kepegawaian_sk_cpns';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function files()
    {
        return $this->hasOne(File::class, 'id_arsip');
    }

    public function getFileLocationAttribute()
    {
        $file = $this->files()->whereJenisArsip(File::SK_CPNS)->first();
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
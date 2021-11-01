<?php

namespace App\Models\Arsip\Kepegawaian;

use App\Models\Administrasi\Pegawai;
use App\Models\Arsip\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pangkat extends Model
{
    protected $table = 'kepegawaian_kenaikan_pangkat';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function file()
    {
        return $this->hasOne(File::class, 'id_arsip');
    }

    public function getFileLocationAttribute()
    {
        $file = $this->file()->whereJenisArsip(File::KENAIKAN_PANGKAT)->first();
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
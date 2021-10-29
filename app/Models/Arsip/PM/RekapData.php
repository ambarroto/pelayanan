<?php

namespace App\Models\Arsip\PM;

use App\Models\Arsip\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RekapData extends Model
{
    protected $table = 'pm_rekap_data';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function file()
    {
        return $this->hasOne(File::class, 'id_arsip');
    }

    public function getFileLocationAttribute()
    {
        $file = $this->file()->whereJenisArsip(File::REKAP_DATA_PM)->first();
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
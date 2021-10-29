<?php

namespace App\Models\Arsip\PP;

use App\Models\Arsip\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DispensiasiNikah extends Model
{
    protected $table = 'pp_dispensiasi_nikah';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function file()
    {
        return $this->hasOne(File::class, 'id_arsip');
    }

    public function getFileLocationAttribute()
    {
        $file = $this->file()->whereJenisArsip(File::DISPENSIASI_NIKAH)->first();
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
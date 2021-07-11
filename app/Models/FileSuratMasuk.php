<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileSuratMasuk extends Model
{
    protected $table = 'file_surat_masuk';

    protected $guarded = ['id'];

    protected $appends = ['file_location'];

    const STATUS_SUKSES = 2;

    /**
     * Tambah file surat masuk
     * 
     * @param int $id_surat_masuk
     * @param string $lokasi
     * @param string $filename
     * @return FileSuratMasuk
     */
    public function addFileSuratMasuk(int $id_surat_masuk, string $lokasi, string $filename): FileSuratMasuk
    {
        return $this->create([
            'id_surat_masuk' => $id_surat_masuk,
            'lokasi' => $lokasi,
            'filename' => $filename
        ]);
    }

    public function getFileLocationAttribute()
    {
        $lokasi = $this->lokasi;
        $filename = $this->filename;
        $lokasi_file = $lokasi . DIRECTORY_SEPARATOR . $filename;
        if (Storage::exists($lokasi_file)) {
            return asset($lokasi_file);
        }
        return 0;
    }

    public function getFilePathAttribute()
    {
        $lokasi = $this->lokasi;
        $filename = $this->filename;
        $lokasi_file = "$lokasi/$filename";
        return $lokasi_file;
    }
}
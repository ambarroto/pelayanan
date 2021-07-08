<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        $lokasi_file = config('app.url') . DIRECTORY_SEPARATOR . $lokasi . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($lokasi . DIRECTORY_SEPARATOR . $filename)) {
            return $lokasi_file;
        }
        return 0;
    }
}
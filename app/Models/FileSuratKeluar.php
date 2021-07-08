<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileSuratKeluar extends Model
{
    protected $table = 'file_surat_keluar';

    protected $guarded = ['id'];

    protected $appends = ['file_location'];

    /**
     * Tambah data file surat keluar
     * 
     * @param int $id_surat_keluar
     * @param string $lokasi
     * @param string $filename
     * @return FileSuratKeluar
     */
    public function addFileSuratKeluar(int $id_surat_keluar, string $lokasi, string $filename): FileSuratKeluar
    {
        return $this->create([
            'id_surat_keluar' => $id_surat_keluar,
            'lokasi' => $lokasi,
            'filename' => $filename
        ]);
    }
}
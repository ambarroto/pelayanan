<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileSkck extends Model
{
    protected $table = 'file_skck';

    protected $guarded = ['id'];

    /**
     * Tambah data file skck
     * 
     * @param int $id_skck
     * @param string $lokasi
     * @param string $filename
     * @return FileSkck
     */
    public function addFile(int $id_skck, string $lokasi, string $filename): FileSkck
    {
        return $this->create([
            'id_skck' => $id_skck,
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

    public function getBase64ImageAttribute()
    {
        $type = pathinfo($this->lokasi . DIRECTORY_SEPARATOR . $this->filename, PATHINFO_EXTENSION);
        $data = file_get_contents($this->lokasi . DIRECTORY_SEPARATOR . $this->filename);
        $encode = base64_encode($data);
        $base64 = "data:image/$type;base64,$encode";
        return $base64;
    }
}
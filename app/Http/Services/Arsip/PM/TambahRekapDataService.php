<?php

namespace App\Http\Services\Arsip\PM;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Models\Arsip\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Models\Arsip\PM\RekapData;

class TambahRekapDataService
{
    /**
     * Tambah data arsip Rekap Data PM
     * 
     * @param string $nama
     * @param UploadedFile $file
     * @return RekapData
     */
    public function tambah(string $nama, UploadedFile $file): RekapData
    {
        DB::beginTransaction();
        try {
            $data = RekapData::create([
                'id_seksi' => 0,
                'nama' => $nama,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah data arsip rekap data.");
        }
        $dir = "file/arsip/PM/Rekap Data";
        /** Upload file */
        $type = $file->getClientOriginalExtension();
        $file_name = "Rekap Data - $nama." . $type;
        $path = public_path($dir);
        try {
            Storage::put("$dir/$file_name", $file->getContent());
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        try {
            File::create([
                'jenis_arsip' => File::REKAP_DATA_PM,
                'id_arsip' => $data->id,
                'lokasi' => $dir,
                'nama_file' => $file_name
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // Event delete file
            if (Storage::exists("$dir/$file_name")) Storage::delete("$dir/$file_name");
            throw new BadRequestException("Gagal menambah file arsip rekap data.");
        }
        DB::commit();
        return $data;
    }
}
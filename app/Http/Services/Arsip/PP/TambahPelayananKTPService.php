<?php

namespace App\Http\Services\Arsip\PP;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Models\Arsip\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Models\Arsip\PP\PelayananKTP;

class TambahPelayananKTPService
{
    /**
     * Tambah data arsip Pelayanan KTP
     * 
     * @param string $nomor_kk
     * @param string $nomor_nik_ktp
     * @param string $nama
     * @param UploadedFile $file
     * @return PelayananKTP
     */
    public function tambah(string $nomor_kk, string $nomor_nik_ktp, string $nama, UploadedFile $file): PelayananKTP
    {
        DB::beginTransaction();
        try {
            $data = PelayananKTP::create([
                'id_seksi' => 0,
                'nomor_kk' => $nomor_kk,
                'nomor_nik_ktp' => $nomor_nik_ktp,
                'nama' => $nama,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah data arsip pelayanan KTP.");
        }
        $dir = "file/arsip/PP/Pelayanan KTP";
        /** Upload file */
        $type = $file->getClientOriginalExtension();
        $file_name = "Pelayanan KTP - $nomor_kk - $nomor_nik_ktp." . $type;
        $path = public_path($dir);
        try {
            Storage::put("$dir/$file_name", $file->getContent());
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        try {
            File::create([
                'jenis_arsip' => File::PELAYANAN_KTP,
                'id_arsip' => $data->id,
                'lokasi' => $dir,
                'nama_file' => $file_name
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // Event delete file
            if (Storage::exists("$dir/$file_name")) Storage::delete("$dir/$file_name");
            throw new BadRequestException("Gagal menambah file arsip pelayanan KTP.");
        }
        DB::commit();
        return $data;
    }
}
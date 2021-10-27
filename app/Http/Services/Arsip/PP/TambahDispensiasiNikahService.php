<?php

namespace App\Http\Services\Arsip\PP;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Models\Arsip\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Models\Arsip\PP\DispensiasiNikah;

class TambahDispensiasiNikahService
{
    /**
     * Tambah data arsip Rekap Data PM
     * 
     * @param string $nomor
     * @param string $tanggal
     * @param UploadedFile $file
     * @return DispensiasiNikah
     */
    public function tambah(string $nomor, string $tanggal, UploadedFile $file): DispensiasiNikah
    {
        DB::beginTransaction();
        $tanggal = validasi_tanggal($tanggal);
        try {
            $data = DispensiasiNikah::create([
                'id_seksi' => 0,
                'nomor' => $nomor,
                'tanggal' => $tanggal,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah data arsip dispensiasi nikah.");
        }
        $dir = "file/arsip/PP/Dispensiasi Nikah";
        /** Upload file */
        $type = $file->getClientOriginalExtension();
        $format_nomor = str_replace('/', '_', $nomor);
        $file_name = "Dispensiasi Nikah - $format_nomor." . $type;
        $path = public_path($dir);
        try {
            Storage::put("$dir/$file_name", $file->getContent());
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        try {
            File::create([
                'jenis_arsip' => File::DISPENSIASI_NIKAH,
                'id_arsip' => $data->id,
                'lokasi' => $dir,
                'nama_file' => $file_name
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // Event delete file
            if (Storage::exists("$dir/$file_name")) Storage::delete("$dir/$file_name");
            throw new BadRequestException("Gagal menambah file arsip dispensiasi nikah.");
        }
        DB::commit();
        return $data;
    }
}
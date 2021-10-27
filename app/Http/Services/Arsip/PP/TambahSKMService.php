<?php

namespace App\Http\Services\Arsip\PP;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Models\Arsip\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Models\Arsip\PP\SKM;

class TambahSKMService
{
    /**
     * Tambah data arsip SKM
     * 
     * @param string $layanan
     * @param string $tahun
     * @param string $bulan
     * @param float $jumlah_koresponden
     * @param float $hasil
     * @param UploadedFile|null $file
     * @return SKM
     */
    public function tambah(string $layanan, string $tahun, string $bulan, float $jumlah_koresponden, float $hasil, UploadedFile $file = null): SKM
    {
        DB::beginTransaction();
        try {
            $data = SKM::create([
                'id_seksi' => 0,
                'layanan' => $layanan,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'jumlah_koresponden' => $jumlah_koresponden,
                'hasil' => $hasil,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah data arsip SKM.");
        }
        if ($file) {
            $dir = "file/arsip/PP/SKM";
            /** Upload file */
            $type = $file->getClientOriginalExtension();
            $file_name = "SKM - tahun $tahun bulan $bulan." . $type;
            $path = public_path($dir);
            try {
                Storage::put("$dir/$file_name", $file->getContent());
            } catch (\Throwable $th) {
                DB::rollBack();
                throw new BadRequestException($th->getMessage());
            }
            try {
                File::create([
                    'jenis_arsip' => File::SKM,
                    'id_arsip' => $data->id,
                    'lokasi' => $dir,
                    'nama_file' => $file_name
                ]);
            } catch (\Throwable $th) {
                DB::rollBack();
                // Event delete file
                if (Storage::exists("$dir/$file_name")) Storage::delete("$dir/$file_name");
                throw new BadRequestException("Gagal menambah file arsip SKM.");
            }
        }
        DB::commit();
        return $data;
    }
}
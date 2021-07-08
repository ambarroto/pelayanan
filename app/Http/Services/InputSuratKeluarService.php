<?php

namespace App\Http\Services;

use App\Models\FileSuratKeluar;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class InputSuratKeluarService
{
    /**
     * Input data surat keluar
     * 
     * @param string $nomor_surat
     * @param string $alamat_tujuan
     * @param string $perihal
     * @param string $penunjuk
     * @param string $tanggal
     * @param array $lampiran
     * @return \App\Models\SuratKeluar
     */
    public function input(string $nomor_surat, string $alamat_tujuan, string $perihal, string $penunjuk, string $tanggal, array $lampiran = [])
    {
        DB::beginTransaction();
        try {
            $tanggal = Carbon::parse($tanggal)->format('Y-m-d');
        } catch (\Throwable $th) {
            throw new BadRequestException("Gagal mendapat tanggal.");
        }
        $tahun = Carbon::now()->format('Y');
        $nomor = get_nomor(new SuratKeluar());
        try {
            $surat_keluar = SuratKeluar::create([
                'nomor' => $nomor,
                'nomor_surat' => $nomor_surat,
                'alamat_tujuan' => $alamat_tujuan,
                'tanggal' => $tanggal,
                'uraian' => $perihal,
                'penunjuk' => $penunjuk,
                'status' => SuratKeluar::STATUS_DONE
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah data surat keluar.");
        }
        $data_file_surat_keluar = [];
        $dir = "file/surat/$tahun/keluar";
        $path = public_path() . DIRECTORY_SEPARATOR . $dir;
        foreach ($lampiran as $index => $file) {
            $nomor_file = $index + 1;
            if ($file instanceof UploadedFile) {
                $filename = "$nomor-$index-" . $file->getClientOriginalName();
                try {
                    $file->move($path, $filename);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    throw new BadRequestException("Gagal mengunggah file ke-$nomor_file.");
                }
            } else {
                DB::rollBack();
                throw new BadRequestException("Format file ke-$nomor_file tidak sesuai.");
            }
            array_push($data_file_surat_keluar, [
                'id_surat_keluar' => $surat_keluar->id,
                'lokasi' => $dir,
                'filename' => $filename,
                'file' => "$path/$filename"
            ]);
        }
        $files = [];
        foreach ($data_file_surat_keluar as $index => $file) {
            array_push($files, $file['file']);
            try {
                $file_surat_keluar = new FileSuratKeluar();
                $file_surat_keluar->addFileSuratKeluar($file['id_surat_keluar'], $file['lokasi'], $file['filename']);
                $data_file_surat_keluar[$index]['id'] = $file_surat_keluar->id;
            } catch (\Throwable $th) {
                DB::rollBack();
                // Event delete file surat keluar
                // Code disini
                foreach ($files as $item) {
                    if (file_exists($item)) unlink($item);
                }
                throw new BadRequestException($th->getMessage());
            }
        }
        foreach ($files as $item) {
            if (file_exists($item)) unlink($item);
        }
        DB::commit();
        return $surat_keluar;
    }
}
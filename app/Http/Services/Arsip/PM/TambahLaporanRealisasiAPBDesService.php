<?php

namespace App\Http\Services\Arsip\PM;

use App\Models\Arsip\PM\LaporanRealisasiAPBDes;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Services\Administrasi\Desa\GetDesaService;
use App\Models\Arsip\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TambahLaporanRealisasiAPBDesService
{
    /**
     * @var GetDesaService
     */
    var $getDesaService;

    public function __construct()
    {
        $this->getDesaService = new GetDesaService;
    }
    
    /**
     * Tambah data arsip laporan realisasi APBDes baru
     * 
     * @param int $id_desa
     * @param int $tahun
     * @param int $semester
     * @param float $anggaran
     * @param float $realisasi
     * @param UploadedFile $file
     * @return LaporanRealisasiAPBDes
     */
    public function tambah(int $id_desa, int $tahun, int $semester, float $anggaran, float $realisasi, UploadedFile $file): LaporanRealisasiAPBDes
    {
        DB::beginTransaction();
        $desa = $this->getDesaService->getById($id_desa);
        try {
            $data = LaporanRealisasiAPBDes::create([
                'id_seksi' => 0,
                'id_desa' => $id_desa,
                'tahun' => $tahun,
                'semester' => $semester,
                'anggaran' => $anggaran,
                'realisasi' => $realisasi,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah arsip laporan realisasi APBDes.");
        }
        $nama_desa = $desa->nama;
        $dir = "file/arsip/PM/Laporan Realisasi APBDes/$nama_desa";
        /** Upload file */
        $type = $file->getClientOriginalExtension();
        $file_name = "Laporan Realisasi APBDes Tahun $tahun Semester $semester." . $type;
        $path = public_path($dir);
        try {
            Storage::put("$dir/$file_name", $file->getContent());
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        try {
            File::create([
                'jenis_arsip' => File::LAPORAN_REALISASI_APBDES,
                'id_arsip' => $data->id,
                'lokasi' => $dir,
                'nama_file' => $file_name
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // Event delete file surat masuk
            if (Storage::exists("$dir/$file_name")) Storage::delete("$dir/$file_name");
            throw new BadRequestException("Gagal menambah file Laporan Realisasi APBDes.");
        }
        DB::commit();
        return $data;
    }
}
<?php

namespace App\Http\Services\Arsip\Kepegawaian;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Services\Administrasi\Pegawai\GetPegawaiService;
use App\Models\Arsip\File;
use App\Models\Arsip\Kepegawaian\SKP;
use Illuminate\Support\Facades\Storage;

class TambahSKPService
{
    /**
     * @var GetPegawaiService
     */
    var $getPegawaiService;

    public function __construct()
    {
        $this->getPegawaiService = new GetPegawaiService;
    }

    /**
     * Tambah data pendidikan baru
     * 
     * @param int $id_pegawai
     * @param string $tahun
     * @param string $nilai
     * @param UploadedFile $file
     * @return Pendidikan
     */
    public function tambah(int $id_pegawai, string $tahun, float $nilai, UploadedFile $file): SKP
    {
        $pegawai = $this->getPegawaiService->getById($id_pegawai);
        DB::beginTransaction();
        try {
            $skp = SKP::create([
                'id_pegawai' => $id_pegawai,
                'tahun' => $tahun,
                'nilai' => $nilai
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah data SKP.");
        }
        $dir = "file/arsip/kepegawaian/" . $pegawai->nama;
        /** Upload file kenaikan pangkat */
        $type = $file->getClientOriginalExtension();
        $file_name = "SKP tahun $tahun." . $type;
        $path = public_path($dir);
        try {
            Storage::put("$dir/$file_name", $file->getContent());
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        try {
            File::create([
                'jenis_arsip' => File::SKP,
                'id_arsip' => $skp->id,
                'lokasi' => $dir,
                'nama_file' => $file_name
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // Event delete file surat masuk
            if (Storage::exists("$dir/$file_name")) Storage::delete("$dir/$file_name");
            throw new BadRequestException("Gagal menambah file SKP.");
        }
        DB::commit();
        return $skp;
    }
}
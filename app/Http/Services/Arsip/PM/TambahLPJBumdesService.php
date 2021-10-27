<?php

namespace App\Http\Services\Arsip\PM;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Services\Administrasi\Desa\GetDesaService;
use App\Models\Arsip\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Models\Arsip\PM\LPJBumdes;

class TambahLPJBumdesService
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
     * Tambah data arsip LPJ Bumdes baru
     * 
     * @param int $id_desa
     * @param string $nama
     * @param int $tahun
     * @param UploadedFile $file
     * @return LPJBumdes
     */
    public function tambah(int $id_desa, string $nama, int $tahun, UploadedFile $file): LPJBumdes
    {
        DB::beginTransaction();
        $desa = $this->getDesaService->getById($id_desa);
        try {
            $data = LPJBumdes::create([
                'id_seksi' => 0,
                'id_desa' => $id_desa,
                'tahun' => $tahun,
                'nama' => $nama,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah arsip LPJ Bumdes.");
        }
        $nama_desa = $desa->nama;
        $dir = "file/arsip/PM/LPJ Bumdes/$nama_desa";
        /** Upload file */
        $type = $file->getClientOriginalExtension();
        $file_name = "LPJ Bumdes - $nama Tahun $tahun." . $type;
        $path = public_path($dir);
        try {
            Storage::put("$dir/$file_name", $file->getContent());
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        try {
            File::create([
                'jenis_arsip' => File::LPJ_BUMDES,
                'id_arsip' => $data->id,
                'lokasi' => $dir,
                'nama_file' => $file_name
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // Event delete file
            if (Storage::exists("$dir/$file_name")) Storage::delete("$dir/$file_name");
            throw new BadRequestException("Gagal menambah file LPJ Bumdes.");
        }
        DB::commit();
        return $data;
    }
}
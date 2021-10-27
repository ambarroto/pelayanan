<?php

namespace App\Http\Services\Arsip\PM;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Services\Administrasi\Desa\GetDesaService;
use App\Models\Arsip\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Models\Arsip\PM\AdministrasiDesa;

class TambahAdministrasiDesaService
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
     * Tambah data arsip Administrasi Desa
     * 
     * @param int $id_desa
     * @param string|null $nama
     * @param int $tahun
     * @param string|null $peruntukan
     * @param UploadedFile $file
     * @return AdministrasiDesa
     */
    public function tambah(int $id_desa, string $nama = null, int $tahun, string $peruntukan = null, UploadedFile $file): AdministrasiDesa
    {
        DB::beginTransaction();
        $desa = $this->getDesaService->getById($id_desa);
        try {
            $data = AdministrasiDesa::create([
                'id_seksi' => 0,
                'id_desa' => $id_desa,
                'tahun' => $tahun,
                'nama' => $nama,
                'peruntukan' => $peruntukan,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah data Administrasi Desa.");
        }
        $nama_desa = $desa->nama;
        $dir = "file/arsip/PM/Administrasi Desa/$nama_desa";
        /** Upload file */
        $type = $file->getClientOriginalExtension();
        $file_name = "Administrasi Desa - $nama Tahun $tahun." . $type;
        $path = public_path($dir);
        try {
            Storage::put("$dir/$file_name", $file->getContent());
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        try {
            File::create([
                'jenis_arsip' => File::ADMINISTRASI_DESA,
                'id_arsip' => $data->id,
                'lokasi' => $dir,
                'nama_file' => $file_name
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // Event delete file
            if (Storage::exists("$dir/$file_name")) Storage::delete("$dir/$file_name");
            throw new BadRequestException("Gagal menambah file Administrasi Desa.");
        }
        DB::commit();
        return $data;
    }
}
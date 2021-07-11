<?php

namespace App\Http\Services;

use App\Models\FileSkck;
use Carbon\Carbon;
use App\Models\Skck;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class InputSkckService
{
    /**
     * tambah pengantar skck baru
     * 
     * @param string $nama
     * @param string $tempat_lahir
     * @param string $tanggal_lahir
     * @param string $alamat
     * @param string $agama
     * @param string $pendidikan
     * @param string $pekerjaan
     * @param string $nomor_surat_dari_desa
     * @param string $status
     * @param string $nik
     * @param string $keperluan
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $foto
     * @return \App\Models\Skck
     */
    public function input(string $nama, string $tempat_lahir, string $tanggal_lahir, string $alamat, string $agama, string $pendidikan, string $pekerjaan, string $nomor_surat_dari_desa, string $status, string $nik, string $keperluan, UploadedFile $foto = null): Skck
    {
        DB::beginTransaction();
        try {
            $tanggal_lahir = Carbon::parse($tanggal_lahir)->format('Y-m-d');
        } catch (\Throwable $th) {
            throw new BadRequestException("Gagal mendapat tanggal lahir.");
        }
        $tahun = Carbon::now()->format('Y');
        $nomor = get_nomor(new Skck());
        try {
            $skck = Skck::create([
                'nomor' => $nomor,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'alamat' => $alamat,
                'agama' => $agama,
                'pendidikan' => $pendidikan,
                'pekerjaan' => $pekerjaan,
                'nomor_surat_dari_desa' => $nomor_surat_dari_desa,
                'status' => $status,
                'nik' => $nik,
                'keperluan' => $keperluan
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah data pengantar SKCK.");
        }
        if (!is_null($foto)) {
            $dir = "file/foto/$tahun/skck";
            $path = public_path() . DIRECTORY_SEPARATOR . $dir;
            $filename = "$nomor-" . $foto->getClientOriginalName();
            $file_skck = new FileSkck();
            try {
                $file_skck->addFile($skck->id, $dir, $filename);
            } catch (\Throwable $th) {
                throw new BadRequestException("Gagal menambah data foto.");
            }
            try {
                Storage::put("$dir/$filename", $foto->getContent());
                correctImageOrientation("$path/$filename");
            } catch (\Throwable $th) {
                DB::rollBack();
                throw new BadRequestException("Gagal mengunggah foto.");
            }
        }
        DB::commit();
        return $skck;
    }
}
<?php

namespace App\Http\Services\Arsip\Kepegawaian;

use App\Models\Arsip\Kepegawaian\Pendidikan;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Services\Administrasi\Pegawai\GetPegawaiService;
use App\Models\Arsip\File;
use Illuminate\Support\Facades\Storage;

class TambahPendidikanService
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
     * @param string $nama
     * @param string $nomor_ijazah
     * @param UploadedFile $ijazah
     * @param UploadedFile|null $transkrip
     * @return Pendidikan
     */
    public function tambah(int $id_pegawai, string $nama, string $nomor_ijazah, UploadedFile $ijazah, UploadedFile $transkrip = null): Pendidikan
    {
        $pegawai = $this->getPegawaiService->getById($id_pegawai);
        DB::beginTransaction();
        try {
            $pendidikan = Pendidikan::create([
                'id_pegawai' => $id_pegawai,
                'nama' => $nama,
                'nomor_ijazah' => $nomor_ijazah
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException("Gagal menambah data pendidikan.");
        }
        $dir = "file/arsip/kepegawaian/" . $pegawai->nama;
        $path = public_path($dir);
        $data_pendidikan = [];
        /** Upload file ijazah */
        $type = $ijazah->getClientOriginalExtension();
        $file_name_ijazah = "$nama - Ijazah." . $type;
        $files = [];
        try {
            Storage::put("$dir/$file_name_ijazah", $ijazah->getContent());
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        array_push($data_pendidikan, [
            'jenis_arsip' => File::PENDIDIKAN,
            'id_arsip' => $pendidikan->id,
            'lokasi' => $dir,
            'nama_file' => $file_name_ijazah
        ]);
        array_push($files, "$dir/$file_name_ijazah");
        /** Upload file transkrip nilai */
        if ($transkrip) {
            $type = $transkrip->getClientOriginalExtension();
            $file_name_transkrip = "$nama - Transkrip nilai." . $type;
            try {
                Storage::put("$dir/$file_name_transkrip", $transkrip->getContent());
            } catch (\Throwable $th) {
                DB::rollBack();
                throw new BadRequestException($th->getMessage());
            }
            array_push($data_pendidikan, [
                'jenis_arsip' => File::PENDIDIKAN,
                'id_arsip' => $pendidikan->id,
                'lokasi' => $dir,
                'nama_file' => $file_name_transkrip
            ]);
            array_push($files, "$dir/$file_name_transkrip");
        }
        foreach ($data_pendidikan as $index => $file) {
            try {
                $file_sk_cpns = new File();
                $file_sk_cpns->create($file);
                $data_pendidikan[$index]['id'] = $file_sk_cpns->id;
            } catch (\Throwable $th) {
                DB::rollBack();
                // Event delete file surat masuk
                foreach ($files as $item) {
                    if (Storage::exists($item)) Storage::delete($item);
                }
                throw new BadRequestException("Gagal menambah file sk cpns.");
            }
        }
        DB::commit();
        return $pendidikan;
    }
}
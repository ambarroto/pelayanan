<?php

namespace App\Http\Services\Arsip\Kepegawaian;

use App\Http\Services\Administrasi\Pegawai\GetPegawaiService;
use App\Models\Arsip\File;
use App\Models\Arsip\Kepegawaian\Pangkat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TambahPangkatService
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
     * Tambah data arsip pangkat baru pegawai
     * 
     * @param int $id_pegawai
     * @param string $nama
     * @param string $nomor_sk
     * @param string $tanggal_sk
     * @param UploadedFile $file
     * @return Pangkat
     */
    public function tambah(int $id_pegawai, string $nama, string $nomor_sk, string $tanggal_sk, UploadedFile $file): Pangkat
    {
        $pegawai = $this->getPegawaiService->getById($id_pegawai);
        $tanggal = validasi_tanggal($tanggal_sk, 'tanggal SK');
        DB::beginTransaction();
        try {
            $pangkat = Pangkat::create([
                'id_pegawai' => $pegawai->id,
                'nama' => $nama,
                'nomor_sk' => $nomor_sk,
                'tanggal_sk' => $tanggal
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException('Gagal menambah data kenaikan pangkat.');
        }
        $dir = "file/arsip/kepegawaian/" . $pegawai->nama;
        /** Upload file kenaikan pangkat */
        $type = $file->getClientOriginalExtension();
        $nama = str_replace('/', '', $nama);
        $file_name = "Pangkat $nama." . $type;
        $path = public_path($dir);
        try {
            Storage::put("$dir/$file_name", $file->getContent());
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        try {
            File::create([
                'jenis_arsip' => File::KENAIKAN_PANGKAT,
                'id_arsip' => $pangkat->id,
                'lokasi' => $dir,
                'nama_file' => $file_name
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // Event delete file surat masuk
            if (Storage::exists("$dir/$file_name")) Storage::delete("$dir/$file_name");
            throw new BadRequestException("Gagal menambah file kenaikan pangkat.");
        }
        DB::commit();
        return $pangkat;
    }
}
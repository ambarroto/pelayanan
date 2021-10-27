<?php

namespace App\Http\Services\Arsip\Kepegawaian;

use App\Models\Arsip\Kepegawaian\SkPns;
use App\Http\Services\Administrasi\Pegawai\GetPegawaiService;
use App\Models\Arsip\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TambahSKPNSService
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
     * Tambah data arsip SK PNS baru
     * 
     * @param int $id_pegawai
     * @param string $nomor_sk
     * @param string $tanggal_sk
     * @param array $file
     * @return SkPns
     */
    public function tambah(int $id_pegawai, string $nomor_sk, string $tanggal_sk, array $file = [])
    {
        $tanggal = validasi_tanggal($tanggal_sk, 'tanggal SK PNS');
        $pegawai = $this->getPegawaiService->getById($id_pegawai);
        DB::beginTransaction();
        try {
            $sk_cpns = SkPns::create([
                'id_pegawai' => $pegawai->id,
                'nomor_sk' => $nomor_sk,
                'tanggal_sk' => $tanggal
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException('Gagal menambah data SK PNS.');
        }
        $data_file_sk_pns = [];
        $dir = "file/arsip/kepegawaian/" . $pegawai->nama;
        $path = public_path($dir);
        $files = [];
        foreach ($file as $index => $file) {
            if ($file instanceof UploadedFile) {
                $type = $file->getClientOriginalExtension();
                $file_name = "SK PNS." . $type;
                try {
                    Storage::put("$dir/$file_name", $file->getContent());
                } catch (\Throwable $th) {
                    DB::rollBack();
                    throw new BadRequestException($th->getMessage());
                }
                array_push($data_file_sk_pns, [
                    'jenis_arsip' => File::SK_PNS,
                    'id_arsip' => $sk_cpns->id,
                    'lokasi' => $dir,
                    'nama_file' => $file_name
                ]);
                array_push($files, "$dir/$file_name");
            } else {
                DB::rollBack();
                foreach ($files as $item) {
                    if (Storage::exists($item)) Storage::delete($item);
                }
                $nomor_file = $index + 1;
                throw new BadRequestException("Format file ke-$nomor_file tidak sesuai.");
            }
        }
        foreach ($data_file_sk_pns as $index => $file) {
            try {
                $file_sk_cpns = new File();
                $file_sk_cpns->create($file);
            } catch (\Throwable $th) {
                DB::rollBack();
                // Event delete file surat masuk
                foreach ($files as $item) {
                    if (Storage::exists($item)) Storage::delete($item);
                }
                throw new BadRequestException("Gagal menambah file SK PNS.");
            }
        }
        DB::commit();
    }
}
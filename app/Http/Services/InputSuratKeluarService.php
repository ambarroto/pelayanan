<?php

namespace App\Http\Services;

use App\Models\FileSuratKeluar;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\PdfToImage\Pdf;
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
        $nomor = get_nomor(new SuratKeluar());
        try {
            $surat_keluar = $this->create($nomor, $nomor_surat, $alamat_tujuan, $tanggal, $perihal, $penunjuk);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        try {
            $this->uploadFileSuratKeluar($surat_keluar, $lampiran);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        DB::commit();
        return $surat_keluar;
    }

    /**
     * Menyisipkan surat keluar
     * 
     * @param string $nomor
     * @param string $nomor_surat
     * @param string $alamat_tujuan
     * @param string $tanggal
     * @param string $perihal
     * @param string $penunjuk
     * @param array $lampiran
     * @return \App\Models\SuratKeluar
     */
    public function sisipkan(string $nomor, string $nomor_surat, string $alamat_tujuan, string $tanggal, string $perihal, string $penunjuk, array $lampiran = []): SuratKeluar
    {
        DB::beginTransaction();
        try {
            $tanggal = Carbon::parse($tanggal)->format('Y-m-d');
        } catch (\Throwable $th) {
            throw new BadRequestException("Gagal mendapat tanggal.");
        }
        try {
            $surat_keluar = $this->create($nomor, $nomor_surat, $alamat_tujuan, $tanggal, $perihal, $penunjuk);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        try {
            $this->uploadFileSuratKeluar($surat_keluar, $lampiran);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        DB::commit();
        return $surat_keluar;
    }

    /**
     * Create surat keluar
     * 
     * @param string $nomor
     * @param string $nomor_surat
     * @param string $alamat_tujuan
     * @param string $tanggal
     * @param string $perihal
     * @param string $penunjuk
     * @return \App\Models\SuratKeluar
     */
    protected function create(string $nomor, string $nomor_surat, string $alamat_tujuan, string $tanggal, string $perihal, string $penunjuk): SuratKeluar
    {
        try {
            $data = SuratKeluar::create([
                'nomor' => $nomor,
                'nomor_surat' => $nomor_surat,
                'alamat_tujuan' => $alamat_tujuan,
                'tanggal' => $tanggal,
                'uraian' => $perihal,
                'penunjuk' => $penunjuk,
                'status' => SuratKeluar::STATUS_DONE
            ]);
        } catch (\Throwable $th) {
            throw new BadRequestException("Gagal menambah data surat keluar.");
        }
        return $data;
    }

    /**
     * Upload file surat keluar
     * 
     * @param \App\Models\SuratKeluar $surat_keluar
     * @param array $lampiran
     * @return mixed
     */
    protected function uploadFileSuratKeluar(SuratKeluar $surat_keluar, array $lampiran = [])
    {
        $nomor = $surat_keluar->nomor;
        $tahun = Carbon::now()->format('Y');
        $data_file_surat_keluar = [];
        $dir = "file/surat/$tahun/keluar";
        $path = public_path() . DIRECTORY_SEPARATOR . $dir;
        foreach ($lampiran as $index => $file) {
            $nomor_file = $index + 1;
            if ($file instanceof UploadedFile) {
                $type = $file->getClientOriginalExtension();
                $filename = "$nomor-$index-" . $file->getClientOriginalName();
                if ($type == 'pdf') {
                    try {
                        $pdf = new Pdf($file);
                    } catch (\Throwable $th) {
                        throw new BadRequestException($th->getMessage());
                    }
                    $number_of_page = $pdf->getNumberOfPages();
                    
                    $file_name = $file->getClientOriginalName();
                    $file_name = explode(".$type", $file_name);
                    $file_name = $file_name[0];
                    $file_name = "$nomor-$index-$file_name";
                    $pdf->setResolution(100);
                    $pdf->setOutputFormat('jpeg');
                    SavePdfAsImageService::saveAllPagesAsImages($pdf, $dir, $file_name);
                    for ($item = 0; $item < $number_of_page; $item++) {
                        $page = $item+1;
                        array_push($data_file_surat_keluar, [
                            'id_surat_keluar' => $surat_keluar->id,
                            'lokasi' => $dir,
                            'filename' => "$file_name-$page.jpeg",
                            'file' => "$path/$file_name-$page.jpeg"
                        ]);
                    }
                } else {
                    try {
                        $file->move($path, $filename);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        throw new BadRequestException("Gagal mengunggah file ke-$nomor_file.");
                    }
                    array_push($data_file_surat_keluar, [
                        'id_surat_keluar' => $surat_keluar->id,
                        'lokasi' => $dir,
                        'filename' => $filename,
                        'file' => "$path/$filename"
                    ]);
                }
            } else {
                throw new BadRequestException("Format file ke-$nomor_file tidak sesuai.");
            }
        }
        $files = [];
        foreach ($data_file_surat_keluar as $index => $file) {
            array_push($files, $file['file']);
            try {
                $file_surat_keluar = new FileSuratKeluar();
                $file_surat_keluar->addFileSuratKeluar($file['id_surat_keluar'], $file['lokasi'], $file['filename']);
                $data_file_surat_keluar[$index]['id'] = $file_surat_keluar->id;
            } catch (\Throwable $th) {
                // Event delete file surat keluar
                // Code disini
                foreach ($files as $item) {
                    if (file_exists($item)) unlink($item);
                }
                throw new BadRequestException($th->getMessage());
            }
        }
    }
}
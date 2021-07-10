<?php

namespace App\Http\Services;

use App\Models\FileSuratMasuk;
use Carbon\Carbon;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Spatie\PdfToImage\Pdf;

class InputSuratMasukService
{
    /**
     * Input surat masuk baru
     * 
     * @param string $nomor_surat
     * @param string $alamat_surat
     * @param string $tanggal_surat
     * @param string $perihal
     * @param array $lampiran
     * @return mixed
     */
    public function input(string $nomor_surat, string $alamat_surat, string $tanggal_surat, string $perihal, array $lampiran = [])
    {
        try {
            $tanggal_surat = Carbon::parse($tanggal_surat)->format('Y-m-d');
        } catch (\Throwable $th) {
            throw new BadRequestException("Gagal mendapat tanggal surat.");
        }
        $tahun = Carbon::now()->format('Y');
        DB::beginTransaction();
        $nomor = get_nomor(new SuratMasuk(), 'tanggal_terima');
        $tanggal_terima = Carbon::now()->format('Y-m-d');
        try {
            $surat = SuratMasuk::create([
                'nomor' => $nomor,
                'tanggal_terima' => $tanggal_terima,
                'alamat_surat' => $alamat_surat,
                'tanggal_surat' => $tanggal_surat,
                'nomor_surat' => $nomor_surat,
                'perihal_surat' => $perihal,
                'status' => SuratMasuk::STATUS_OPEN
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new BadRequestException($th->getMessage());
        }
        $data_file_surat_masuk = [];
        $dir = "file/surat/$tahun/masuk";
        $path = public_path($dir);
        foreach ($lampiran as $index => $file) {
            if ($file instanceof UploadedFile) {
                $type = $file->getClientOriginalExtension();
                if ($type == 'pdf') {
                    $file_name = "$nomor-$index-" . $file->getClientOriginalName();
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
                    $this->saveAllPagesAsImages($pdf, $dir, $file_name);
                    for ($item = 0; $item < $number_of_page; $item++) {
                        $page = $item+1;
                        array_push($data_file_surat_masuk, [
                            'id_surat_masuk' => $surat->id,
                            'lokasi' => $dir,
                            'filename' => "$file_name-$page.jpeg",
                            'file' => "$path/$file_name-$page.jpeg"
                        ]);
                    }
                } else {
                    $file_name = "$nomor-$index-" . $file->getClientOriginalName();
                    try {
                        Storage::put("$dir/$file_name", $file->getContent());
                        $this->correctImageOrientation("$path/$file_name");
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        throw new BadRequestException($th->getMessage());
                    }
                    array_push($data_file_surat_masuk, [
                        'id_surat_masuk' => $surat->id,
                        'lokasi' => $dir,
                        'filename' => $file_name,
                        'file' => "$path/$file_name"
                    ]);
                }
            } else {
                DB::rollBack();
                $nomor_file = $index + 1;
                throw new BadRequestException("Format file ke-$nomor_file tidak sesuai.");
            }
        }
        $files = [];
        foreach ($data_file_surat_masuk as $index => $file) {
            array_push($files, $file['file']);
            try {
                $file_surat_masuk = new FileSuratMasuk();
                $file_surat_masuk->addFileSuratMasuk($file['id_surat_masuk'], $file['lokasi'], $file['filename']);
                $data_file_surat_masuk[$index]['id'] = $file_surat_masuk->id;
            } catch (\Throwable $th) {
                DB::rollBack();
                // Event delete file surat masuk
                foreach ($files as $item) {
                    $lokasi_file = $file['lokasi'] . DIRECTORY_SEPARATOR . $file['filename'];
                    if (Storage::exists($lokasi_file)) Storage::delete($lokasi_file);
                }
                throw new BadRequestException("Gagal menambah file surat masuk.");
            }
        }
        DB::commit();
        return $surat;
    }

    public function correctImageOrientation($filename)
    {
        if (function_exists('exif_read_data')) {
            $exif = exif_read_data($filename);
            if($exif && isset($exif['Orientation'])) {
                $orientation = $exif['Orientation'];
                if($orientation != 1){
                    $img = imagecreatefromjpeg($filename);
                    $deg = 0;
                    switch ($orientation) {
                        case 3:
                            $deg = 180;
                        break;
                        case 6:
                            $deg = 270;
                        break;
                        case 8:
                            $deg = 90;
                        break;
                    }
                    if ($deg) {
                        $img = imagerotate($img, $deg, 0);        
                    }
                // then rewrite the rotated image back to the disk as $filename 
                    imagejpeg($img, $filename, 95);
                } // if there is some rotation necessary
            } // if have the exif orientation info
        } // if function exists      
    }

    public function saveImage(PDF $pdf, string $pathToImage): bool
    {
        $page = 1;

        if (is_dir($pathToImage)) {
            $pathToImage = rtrim($pathToImage, '\/').DIRECTORY_SEPARATOR.$page.'.'.$pdf->getOutputFormat();
        }
        
        $imageData = $pdf->getImageData($pathToImage);

        return Storage::put($pathToImage, $imageData) !== false;
    }

    public function saveAllPagesAsImages(PDF $pdf, string $directory, string $prefix = ''): array
    {
        $numberOfPages = $pdf->getNumberOfPages();

        if ($numberOfPages === 0) {
            return [];
        }

        return array_map(function ($pageNumber) use ($pdf, $directory, $prefix) {
            $pdf->setPage($pageNumber);
            
            $destination = "{$directory}/{$prefix}-{$pageNumber}.{$pdf->getOutputFormat()}";

            $this->saveImage($pdf, $destination);

            return $destination;
        }, range(1, $numberOfPages));
    }
}
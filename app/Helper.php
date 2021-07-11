<?php

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Request;

if (!function_exists('route_name_is')) {
    /**
     * 
     * @param string $route_name
     * @return string
     */
    function route_name_is($route_name): string {
        if (Request::routeIs($route_name)) {
            return 'active';
        }
        return 'test';
    }
}

if (!function_exists('validasi_tanggal')) {
    /**
     * @param string $tanggal
     * @param string $text
     * @return mixed
     */
    function validasi_tanggal($tanggal, string $text = '') {
        try {
            $tanggal = Carbon::parse($tanggal)->format('Y-m-d');
        } catch (\Throwable $th) {
            throw new BadRequestException("Gagal mendapat $text.");
        }
        return $tanggal;
    }
}

if (!function_exists('get_nomor')) {
    /**
     * @param Illuminate\Database\Eloquent\Model $model
     * @param string $kolom_tanggal
     * @return float
     */
    function get_nomor(Model $model, string $kolom_tanggal = 'tanggal') {
        $tahun = Carbon::now()->format('Y');
        $data_pertama = $model->whereYear($kolom_tanggal, $tahun)->orderBy($kolom_tanggal, 'asc')->first();
        if ($data_pertama) {
            $data_terakhir = $model->whereYear($kolom_tanggal, $tahun)->latest('nomor')->first();
            $nomor = $data_terakhir->nomor + 1;
        } else {
            $nomor = 1;
        }
        return $nomor;
    }
}

if (!function_exists('tanggal_indonesia')) {
    /**
     * Format tanggal ke indonesia
     * 
     * @param string $date
     * @return mixed
     */
    function tanggal_indonesia(string $date) {
        setlocale(LC_TIME, 'id_ID');
        $date = Carbon::now()->locale('id_ID');
        try {
            $tanggal = Carbon::parse($date);
        } catch (\Throwable $th) {
            return 'Tanggal gagal diformat';
        }
        return $tanggal->isoFormat('D MMMM Y');
    }
}

if (!function_exists('tanggal')) {
    /**
     * Format tanggal
     * 
     * @param string $date
     * @return mixed
     */
    function tanggal(string $date) {
        try {
            $tanggal = Carbon::parse($date);
        } catch (\Throwable $th) {
            return 'Tanggal gagal diformat';
        }
        return $tanggal->format('d-m-Y');
    }
}

if (!function_exists('correctImageOrientation')) {
    /**
     * Memperbaiki orientasi gambar
     * 
     * @param string $filename
     */
    function correctImageOrientation($filename) {
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
}
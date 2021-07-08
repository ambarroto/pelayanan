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
        return $tanggal->isoFormat('d MMMM Y');
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
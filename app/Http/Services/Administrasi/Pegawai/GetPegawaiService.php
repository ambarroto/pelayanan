<?php

namespace App\Http\Services\Administrasi\Pegawai;

use App\Models\Administrasi\Pegawai;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetPegawaiService
{
    /**
     * Return total pegawai
     * 
     * @return mixed
     */
    public static function totalPegawai()
    {
        return Pegawai::count();
    }

    /**
     * Return all pegawai
     * 
     * @return Pegawai
     */
    public function get()
    {
        return Pegawai::all();
    }

    /**
     * Mengambil data pegawai dari id yg diberikan
     * 
     * @param int $id
     * @return Pegawai
     */
    public function getById(int $id): Pegawai
    {
        try {
            $pegawai = Pegawai::whereId($id)->firstOrFail();
        } catch (\Throwable $th) {
            throw new ModelNotFoundException('Pegawai tidak ditemukan.');
        }
        return $pegawai;
    }
}
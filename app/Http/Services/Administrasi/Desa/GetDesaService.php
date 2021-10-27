<?php

namespace App\Http\Services\Administrasi\Desa;

use App\Models\Administrasi\Desa;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetDesaService
{
    public function get()
    {
        return Desa::all();
    }

    /**
     * Mengambil data desa berdasarkan id yg diberikan
     * 
     * @param int $id_desa
     * @return Desa
     */
    public function getById(int $id_desa): Desa
    {
        $desa = Desa::whereId($id_desa)->first();
        if (!$desa) throw new ModelNotFoundException("Data desa tidak ditemukan.");
        return $desa;
    }
}
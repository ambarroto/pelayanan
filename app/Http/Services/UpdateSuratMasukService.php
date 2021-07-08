<?php

namespace App\Http\Services;

use App\Models\SuratMasuk;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UpdateSuratMasukService
{
    /**
     * Update data surat masuk (isi disposisi)
     * 
     * @param int $id
     * @param string $isi_disposisi
     * @return mixed
     */
    public function update(int $id, string $isi_disposisi)
    {
        DB::beginTransaction();
        $service = new SuratMasukService;
        $surat_masuk = $service->detil($id);
        try {
            $surat_masuk->update([
                'catatan' => $isi_disposisi
            ]);
        } catch (\Throwable $th) {
            throw new BadRequestException("Gagal merubah isi disposisi");
        }
        DB::commit();
    }
}
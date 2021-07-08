<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    const STATUS_OPEN = 0;
    const STATUS_CLOSED = 1;
    
    protected $table = 'surat_masuk';

    protected $guarded = ['id'];

    public function getNomorAgendaAttribute()
    {
        $nomor_surat = $this->nomor_surat;
        $nomor_dasar = explode('/', $nomor_surat)[0];
        $nomor = $this->nomor;
        $tahun = Carbon::parse($this->tanggal_terima)->format('Y');
        $kode = config('app.kode_opd');
        return "$nomor_dasar/$nomor/$kode/$tahun";
    }

    public function fileSuratMasuk()
    {
        return $this->hasMany(FileSuratMasuk::class, 'id_surat_masuk');
    }
}
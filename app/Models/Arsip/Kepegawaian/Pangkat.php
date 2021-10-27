<?php

namespace App\Models\Arsip\Kepegawaian;

use App\Models\Administrasi\Pegawai;
use App\Models\Arsip\File;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $table = 'kepegawaian_kenaikan_pangkat';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function file()
    {
        return $this->hasOne(File::class, 'id_arsip');
    }
}
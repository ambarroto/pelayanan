<?php

namespace App\Models\Arsip\Kepegawaian;

use App\Models\Administrasi\Pegawai;
use App\Models\Arsip\File;
use Illuminate\Database\Eloquent\Model;

class Berkala extends Model
{
    protected $table = 'kepegawaian_berkala';

    protected $fillable = ['id', 'updated_at', 'created_at'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function file()
    {
        return $this->hasOne(File::class, 'id_arsip');
    }
}
<?php

namespace App\Models\Arsip\Kepegawaian;

use App\Models\Administrasi\Pegawai;
use App\Models\Arsip\File;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $table = 'kepegawaian_ijazah_transkrip';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'id_arsip');
    }
}
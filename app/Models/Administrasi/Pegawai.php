<?php

namespace App\Models\Administrasi;

use App\Models\Arsip\Kepegawaian\Pangkat;
use App\Models\Arsip\Kepegawaian\Pendidikan;
use App\Models\Arsip\Kepegawaian\SkCpns;
use App\Models\Arsip\Kepegawaian\SKP;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function skCpns()
    {
        return $this->hasOne(SkCpns::class, 'id_pegawai');
    }

    public function skPns()
    {
        return $this->hasOne(SkPns::class, 'id_pegawai');
    }

    public function pendidikan()
    {
        return $this->hasMany(Pendidikan::class, 'id_pegawai');
    }

    public function pangkat()
    {
        return $this->hasMany(Pangkat::class, 'id_pegawai');
    }

    public function skp()
    {
        return $this->hasMany(SKP::class, 'id_pegawai');
    }
}
<?php

namespace App\Models\Administrasi;

use Illuminate\Database\Eloquent\Model;

class Seksi extends Model
{
    protected $table = 'seksi';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function pegawaiPejabat()
    {
        return $this->belongsTo(Pegawai::class, 'pejabat', 'id');
    }
}
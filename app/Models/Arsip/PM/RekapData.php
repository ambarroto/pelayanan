<?php

namespace App\Models\Arsip\PM;

use App\Models\Arsip\File;
use Illuminate\Database\Eloquent\Model;

class RekapData extends Model
{
    protected $table = 'pm_rekap_data';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function file()
    {
        return $this->hasOne(File::class, 'id_arsip');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    const STATUS_DONE = 1;
    
    protected $table = 'surat_keluar';

    protected $guarded = ['id'];
}
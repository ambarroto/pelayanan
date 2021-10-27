<?php

namespace App\Models\Arsip\PP;

use Illuminate\Database\Eloquent\Model;

class PelayananKTP extends Model
{
    protected $table = 'pp_pelayanan_ktp';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
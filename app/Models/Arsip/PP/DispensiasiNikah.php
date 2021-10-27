<?php

namespace App\Models\Arsip\PP;

use Illuminate\Database\Eloquent\Model;

class DispensiasiNikah extends Model
{
    protected $table = 'pp_dispensiasi_nikah';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
<?php

namespace App\Models\Arsip\PP;

use Illuminate\Database\Eloquent\Model;

class SKM extends Model
{
    protected $table = 'pp_skm';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
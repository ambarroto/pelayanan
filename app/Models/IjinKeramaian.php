<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IjinKeramaian extends Model
{
    const STATUS_SUCCESS = 2;
    const STATUS_FAILED = 3;
    
    protected $table = 'ijin_keramaian';

    protected $guarded = ['id'];
}
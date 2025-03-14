<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acadyear extends Model
{
    //
    protected $table = 'school_yr';

    protected $fillable = ['name', 'status', 'is_active'];
}

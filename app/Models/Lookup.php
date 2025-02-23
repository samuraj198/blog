<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lookup extends Model
{
    protected $table = 'tbl_lookup';
    protected $fillable = [
        'name',
        'code',
        'type',
        'position'
    ];
}

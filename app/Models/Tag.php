<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tbl_tag';
    protected $fillable = [
        'name',
        'frequency'
    ];
}

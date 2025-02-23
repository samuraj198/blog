<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'tbl_post';
    protected $fillable = [
        'title',
        'content',
        'tags',
        'status',
        'user_id'
    ];
}

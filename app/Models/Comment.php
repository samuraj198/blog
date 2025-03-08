<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'tbl_comment';
    protected $fillable = [
        'content',
        'status',
        'author',
        'email',
        'url',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

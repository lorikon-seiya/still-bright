<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    // 多对多：一个标签包含多篇文章
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }

    public $timestamps = false;
}

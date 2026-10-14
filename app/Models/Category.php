<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'color'];
    // 一对多：一个分类包含多篇文章
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public $timestamps = false;
}

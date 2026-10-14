<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Post extends Model implements Feedable
{

    // --- RSS 订阅接口实现 ---
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->summary ?? $this->title)
            ->updated($this->updated_at)
            ->link(route('posts.show', $this->slug))
            ->authorName('SwiftHub Blog');
    }
    public static function getFeedItems()
    {
        return Post::where('is_published', true)->latest('published_at')->get();
    }
    // 增加这个方法（解决 config/feed.php 的调用）
    public static function getAllFeedItems()
    {
        return static::getFeedItems();
    }

    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'cover_image',
        'swift_version',
        'target_platform',
        'category_id',
        'is_published',
        'published_at',
        'views_count',
    ];
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
    // 多对一：文章属于某个分类
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // 多对多：文章包含多个标签
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

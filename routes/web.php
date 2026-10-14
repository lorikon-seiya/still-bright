<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

use App\Models\Post;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

// 博客首页
Route::get('/', [PostController::class, 'index'])->name('posts.index');
// 文章详情页
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');

// 2. 自动挂载 RSS 订阅路由 (/feed)
Route::feeds();

// 3. 动态生成 Sitemap.xml 路由
Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();
    // 首页
    $sitemap->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
    // 动态添加所有已发布的 Swift 文章
    Post::where('is_published', true)->each(function (Post $post) use ($sitemap) {
        $sitemap->add(
            Url::create(route('posts.show', $post->slug))
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8)
        );
    });
    return $sitemap->toResponse(request());
});

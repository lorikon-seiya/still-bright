<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\MarkdownService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 博客首页：显示公开文章列表
    public function index(Request $request)
    {
        $query = Post::with(['category', 'tags'])
            ->where('is_published', true)
            ->latest('published_at');

        // 按分类筛选
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // 按搜索词检索
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(9);
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    // 文章详情页
    public function show(string $slug)
    {
        $post = Post::with(['category', 'tags'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // 增加阅读量
        $post->increment('views_count');

        // 解析 Markdown 为 HTML
        $htmlContent = MarkdownService::parse($post->content);

        // 相关推荐文章
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'htmlContent', 'relatedPosts'));
    }
}

@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- 返回首页 -->
    <a href="{{ route('posts.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-swift mb-6 transition-colors">
        ← 返回文章列表
    </a>

    <!-- 文章头图信息 -->
    <header class="mb-10">
        <div class="flex items-center gap-3 mb-4">
            <span class="px-3 py-1 text-xs font-bold rounded-lg bg-swift text-white">
                {{ $post->swift_version }}
            </span>
            @if($post->target_platform)
            <span class="px-3 py-1 text-xs font-medium rounded-lg bg-gray-100 text-gray-700">
                {{ $post->target_platform }}
            </span>
            @endif
            <span class="text-sm font-medium text-gray-500">
                • {{ $post->category->name }}
            </span>
        </div>

        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
            {{ $post->title }}
        </h1>

        <div class="mt-4 flex items-center text-sm text-gray-500 space-x-4">
            <span>发布于 {{ $post->published_at?->format('Y年m月d日') }}</span>
            <span>•</span>
            <span>{{ $post->views_count }} 次阅读</span>
        </div>

        <!-- 标签展示 -->
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach($post->tags as $tag)
            <span class="px-2.5 py-0.5 text-xs rounded-md bg-gray-100 text-gray-600 border border-gray-200">
                #{{ $tag->name }}
            </span>
            @endforeach
        </div>
    </header>

    <!-- Markdown 文章主正文 (Tailwind 文章样式) -->
    <article class="prose prose-lg max-w-none prose-orange prose-pre:bg-[#282c34] prose-pre:p-4 prose-pre:rounded-xl">
        {!! $htmlContent !!}
    </article>

</div>
@endsection
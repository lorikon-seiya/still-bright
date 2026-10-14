@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Hero 标语块 -->
    <div class="text-center py-10">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">
            Exploring <span class="text-swift">Swift</span> & <span class="text-blue-500">SwiftUI</span>
        </h1>
        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
            Practical Insights and Core Principles of Advanced iOS 18, Swift 6.0, and SwiftData Development.
        </p>
    </div>

    <!-- 分类筛选 Pill 标签 -->
    <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
        <a href="{{ route('posts.index') }}"
            class="px-4 py-2 text-sm font-medium rounded-full border {{ !request('category') ? 'bg-swift text-white border-swift' : 'bg-white text-gray-700 hover:bg-gray-100 border-gray-300' }}">
            All Posts
        </a>
        @foreach($categories as $category)
        <a href="{{ route('posts.index', ['category' => $category->slug]) }}"
            class="px-4 py-2 text-sm font-medium rounded-full border {{ request('category') === $category->slug ? 'bg-swift text-white border-swift' : 'bg-white text-gray-700 hover:bg-gray-100 border-gray-300' }}">
            {{ $category->name }}
        </a>
        @endforeach
    </div>

    <!-- 文章卡片网格 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
        <article class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col">
            <div class="p-6 flex-grow flex flex-col justify-between">
                <div>
                    <!-- 顶部徽章（Swift 版本 + 分类） -->
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-md bg-orange-50 text-swift border border-orange-200">
                            {{ $post->swift_version }}
                        </span>
                        <span class="text-xs text-gray-500 font-medium">
                            {{ $post->category->name }}
                        </span>
                    </div>

                    <!-- 文章标题 -->
                    <h2 class="text-xl font-bold text-gray-900 hover:text-swift transition-colors line-clamp-2">
                        <a href="{{ route('posts.show', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <!-- 文章摘要 -->
                    <p class="mt-3 text-sm text-gray-600 line-clamp-3">
                        {{ $post->summary }}
                    </p>
                </div>

                <!-- 卡片底部元数据 -->
                <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-400">
                    <span>{{ $post->published_at?->format('Y-m-d') }}</span>
                    <span>{{ $post->views_count }} 次阅读</span>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-full text-center py-12 text-gray-500">
            暂无相关 Swift 文章
        </div>
        @endforelse
    </div>

    <!-- 分页链接 -->
    <div class="mt-12">
        {{ $posts->links() }}
    </div>

</div>
@endsection
@extends('layouts.app')

@section('title', 'Swift 问答社区 - 提问与解答')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- 顶部标题与我要提问按钮 -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                 Swift <span class="text-swift">Questions</span>
            </h1>
            <p class="mt-2 text-sm text-gray-600">
                Discuss Swift 6.0 concurrency, SwiftUI layout pitfalls, and iOS architecture issues.
            </p>
        </div>

        <a href="{{ route('questions.create') }}"
            class="inline-flex items-center justify-center px-5 py-2.5 bg-swift hover:bg-orange-600 text-white font-medium text-sm rounded-xl shadow-sm transition-all hover:scale-105">
            + Question
        </a>
    </div>

    <!-- 筛选标签 (全部 / 待解答 / 已解决) -->
    <div class="flex items-center space-x-2 border-b border-gray-200 pb-4 mb-6">
        <a href="{{ route('questions.index') }}"
            class="px-3 py-1.5 text-sm font-medium rounded-lg {{ !request('filter') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            All
        </a>
        <a href="{{ route('questions.index', ['filter' => 'unsolved']) }}"
            class="px-3 py-1.5 text-sm font-medium rounded-lg {{ request('filter') === 'unsolved' ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            Unsolved
        </a>
        <a href="{{ route('questions.index', ['filter' => 'solved']) }}"
            class="px-3 py-1.5 text-sm font-medium rounded-lg {{ request('filter') === 'solved' ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            Solved
        </a>
    </div>

    <!-- 问题列表 -->
    <div class="space-y-4">
        @forelse($questions as $question)
        <div class="bg-white p-5 rounded-2xl border border-gray-200 hover:border-gray-300 transition-all shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    @if($question->is_resolved)
                    <span class="px-2.5 py-0.5 text-xs font-semibold rounded-md bg-emerald-50 text-emerald-600 border border-emerald-200">
                        ✓ Solved
                    </span>
                    @else
                    <span class="px-2.5 py-0.5 text-xs font-semibold rounded-md bg-gray-100 text-gray-600">
                        {{ $question->answers_count }} Answer
                    </span>
                    @endif

                    <span class="px-2 py-0.5 text-xs font-mono font-medium rounded bg-orange-50 text-swift border border-orange-200">
                        {{ $question->swift_version }}
                    </span>

                    <span class="text-xs text-gray-400">
                        {{ $question->user->name }} • {{ $question->created_at->diffForHumans() }}
                    </span>
                </div>

                <h2 class="text-lg font-bold text-gray-900 hover:text-swift">
                    <a href="{{ route('questions.show', $question->slug) }}">
                        {{ $question->title }}
                    </a>
                </h2>

                <!-- 标签 -->
                <div class="flex flex-wrap gap-1.5">
                    @foreach($question->tags as $tag)
                    <span class="text-xs px-2 py-0.5 bg-gray-50 text-gray-600 rounded">
                        #{{ $tag->name }}
                    </span>
                    @endforeach
                </div>
            </div>

            <div class="text-right sm:flex-shrink-0 text-xs text-gray-400">
                {{ $question->views_count }} Views
            </div>
        </div>
        @empty
        <div class="text-center py-12 text-gray-400 bg-white rounded-2xl border border-dashed border-gray-300">
            No Questions, Welcome to ask your first Swift question!
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $questions->links() }}
    </div>

</div>
@endsection
@extends('layouts.app')

@section('title', $question->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

    <!-- 问题主体 -->
    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-gray-200 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
            @if($question->is_resolved)
            <span class="px-3 py-1 text-xs font-bold rounded-lg bg-emerald-50 text-emerald-600 border border-emerald-200">
                ✓ 已解决
            </span>
            @endif
            <span class="px-2.5 py-1 text-xs font-mono font-bold rounded-lg bg-orange-50 text-swift border border-orange-200">
                {{ $question->swift_version }}
            </span>
            @if($question->target_platform)
            <span class="px-2.5 py-1 text-xs font-medium rounded-lg bg-gray-100 text-gray-700">
                {{ $question->target_platform }}
            </span>
            @endif
        </div>

        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-4">
            {{ $question->title }}
        </h1>

        <div class="flex items-center space-x-3 text-xs text-gray-500 border-b border-gray-100 pb-4 mb-6">
            <img src="{{ $question->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($question->user->name) }}" class="w-6 h-6 rounded-full">
            <span>{{ $question->user->name }}</span>
            <span>•</span>
            <span>发布于 {{ $question->created_at->diffForHumans() }}</span>
            <span>•</span>
            <span>{{ $question->views_count }} 次浏览</span>
        </div>

        <!-- 问题 Markdown 正文 -->
        <article class="prose prose-orange max-w-none prose-pre:bg-[#282c34]">
            {!! $questionHtml !!}
        </article>
    </div>

    <!-- 回答列表 -->
    <div class="space-y-6">
        <h2 class="text-xl font-bold text-gray-900">
            全部回答 ({{ $answers->count() }})
        </h2>

        @forelse($answers as $answer)
        <div class="p-6 rounded-2xl border transition-all {{ $answer->is_best ? 'bg-emerald-50/40 border-emerald-400 ring-2 ring-emerald-400/20' : 'bg-white border-gray-200' }}">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ $answer->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($answer->user->name) }}" class="w-7 h-7 rounded-full">
                    <div>
                        <span class="text-sm font-bold text-gray-900">{{ $answer->user->name }}</span>
                        <span class="text-xs text-gray-400 ml-2">{{ $answer->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- 最佳答案徽章 -->
                @if($answer->is_best)
                <span class="px-3 py-1 bg-emerald-500 text-white text-xs font-bold rounded-full flex items-center gap-1 shadow-sm">
                    ★ 最佳答案 (已采纳)
                </span>
                @elseif(auth()->id() === $question->user_id)
                <!-- 提问者本人的采纳按钮 -->
                <form action="{{ route('answers.best', [$question->id, $answer->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3 py-1 bg-white hover:bg-emerald-50 text-emerald-600 border border-emerald-300 text-xs font-semibold rounded-lg transition-colors">
                        采纳此回答
                    </button>
                </form>
                @endif
            </div>

            <!-- 回答正文 -->
            <article class="prose prose-orange max-w-none text-sm prose-pre:bg-[#282c34]">
                {!! \App\Services\MarkdownService::parse($answer->content) !!}
            </article>
        </div>
        @empty
        <div class="text-center py-8 text-gray-400 bg-white rounded-2xl border border-gray-200">
            还没有人回答这个问题，快来写下你的见解吧！
        </div>
        @endforelse
    </div>

    <!-- 撰写回答表单 -->
    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-gray-200 shadow-sm">
        @auth
        <h3 class="text-lg font-bold text-gray-900 mb-4">撰写你的回答</h3>
        <form action="{{ route('answers.store', $question->id) }}" method="POST" class="space-y-4">
            @csrf
            <textarea name="content" rows="6" required
                placeholder="写下你的解答或贴出可运行的 Swift 代码 (支持 Markdown 与 ```swift)..."
                class="w-full px-4 py-2 border border-gray-300 rounded-xl font-mono text-sm focus:ring-2 focus:ring-swift focus:outline-none"></textarea>
            <button type="submit" class="px-6 py-2 bg-swift hover:bg-orange-600 text-white font-medium rounded-xl shadow-sm">
                提交回答
            </button>
        </form>
        @else
        <div class="text-center py-6">
            <p class="text-sm text-gray-600 mb-3">登录后即可参与技术讨论与撰写回答</p>
            <a href="{{ route('auth.github') }}" class="inline-flex items-center space-x-2 px-5 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-xl shadow-sm">
                <span>使用 GitHub 快捷登录</span>
            </a>
        </div>
        @endauth
    </div>

</div>
@endsection
@extends('layouts.app')

@section('title', '首页 - Swift 学习博客')

@section('content')
<!-- 2. 主体登录卡片区 -->
<main class="flex-1 flex flex-col justify-center items-center px-4 py-12">
    <div class="w-full sm:max-w-md bg-white p-8 sm:p-10 rounded-2xl shadow-xl shadow-gray-100 border border-gray-100">

        <!-- 卡片头部标题 -->
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-swift/10 text-swift rounded-2xl flex items-center justify-center font-bold text-2xl mx-auto mb-3">
                S
            </div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">欢迎回来</h2>
            <p class="text-sm text-gray-500 mt-1">
                还没有账号？
                <a href="{{ route('register') }}" class="font-medium text-swift hover:underline">立即免费注册</a>
            </p>
        </div>

        <!-- Session 状态提示 (如密码重置成功) -->
        @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
            {{ session('status') }}
        </div>
        @endif

        <!-- 登录表单 -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- 邮箱地址 -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">电子邮箱</label>
                <input id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="name@example.com"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-swift focus:ring-4 focus:ring-swift/10 outline-none transition @error('email') border-red-400 @enderror" />
                @error('email')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- 密码 -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label for="password" class="block text-sm font-medium text-gray-700">登录密码</label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-medium text-gray-500 hover:text-swift transition-colors">
                        忘记密码？
                    </a>
                    @endif
                </div>
                <input id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-swift focus:ring-4 focus:ring-swift/10 outline-none transition @error('password') border-red-400 @enderror" />
                @error('password')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- 记住我 -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-swift focus:ring-swift/20 focus:ring-offset-0 transition" />
                    <span class="ms-2 text-sm text-gray-600">记住登录状态</span>
                </label>
            </div>

            <!-- 分割线 -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-xs uppercase">
                    <span class="bg-white px-3 text-gray-400">或者使用其他方式登录</span>
                </div>
            </div>

            <!-- 第三方登录按钮 (以 GitHub 为例) -->
            <a href=""
                class="w-full flex items-center justify-center gap-2.5 py-2.5 px-4 border border-gray-200 hover:bg-gray-50 rounded-xl text-sm font-medium text-gray-700 transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                </svg>
                使用 GitHub 登录
            </a>

            <!-- 登录提交按钮 -->
            <button type="submit"
                class="w-full py-2.5 px-4 bg-swift hover:opacity-90 active:scale-[0.99] text-white font-medium text-sm rounded-xl shadow-md shadow-swift/25 transition-all">
                登 录
            </button>
        </form>
    </div>
</main>

@endsection
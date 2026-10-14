@extends('layouts.app')

@section('title', '首页 - Swift 学习博客')

@section('content')
<!-- 2. 主体注册卡片区 -->
<main class="flex-1 flex flex-col justify-center items-center px-4 py-12">
    <div class="w-full sm:max-w-md bg-white p-8 sm:p-10 rounded-2xl shadow-xl shadow-gray-100 border border-gray-100">

        <!-- 卡片头部标题 -->
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-swift/10 text-swift rounded-2xl flex items-center justify-center font-bold text-2xl mx-auto mb-3">
                S
            </div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">创建新账号</h2>
            <p class="text-sm text-gray-500 mt-1">
                已有账号？
                <a href="{{ route('login') }}" class="font-medium text-swift hover:underline">直接登录</a>
            </p>
        </div>

        <!-- 注册表单 -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- 用户名 / 昵称 -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">用户名 / 昵称</label>
                <input id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="例如：Alex"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-swift focus:ring-4 focus:ring-swift/10 outline-none transition @error('name') border-red-400 @enderror" />
                @error('name')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- 邮箱地址 -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">电子邮箱</label>
                <input id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    placeholder="name@example.com"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-swift focus:ring-4 focus:ring-swift/10 outline-none transition @error('email') border-red-400 @enderror" />
                @error('email')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- 密码 -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">设置密码</label>
                <input id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="至少 8 位字符"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-swift focus:ring-4 focus:ring-swift/10 outline-none transition @error('password') border-red-400 @enderror" />
                @error('password')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- 确认密码 -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">确认密码</label>
                <input id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="请再次输入密码"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:border-swift focus:ring-4 focus:ring-swift/10 outline-none transition @error('password_confirmation') border-red-400 @enderror" />
                @error('password_confirmation')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- 注册按钮 -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full py-2.5 px-4 bg-swift hover:opacity-90 active:scale-[0.99] text-white font-medium text-sm rounded-xl shadow-md shadow-swift/25 transition-all">
                    立即注册
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
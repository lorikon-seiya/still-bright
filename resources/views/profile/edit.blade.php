@extends('layouts.app')

@section('title', '个人设置 - SwiftHub')

@section('content')
<div class="py-10 bg-gray-50/60 min-h-[calc(100vh-64px)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- 页面头部标题 -->
        <div class="border-b border-gray-200/80 pb-5">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Settings</h1>
            <p class="text-sm text-gray-500 mt-1.5">
                Manage your SwiftHub account information, login password, and security preferences.
            </p>
        </div>

        <!-- 1. 基本资料设置 -->
        <section class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </section>

        <!-- 2. 安全与修改密码 -->
        <section class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </section>

        <!-- 3. 危险区域：注销账号 -->
        <section class="bg-white rounded-2xl border border-red-100 shadow-sm hover:shadow-md transition-shadow p-6 sm:p-8 relative overflow-hidden">
            <!-- 顶部红色警示小细条 -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-red-500/80"></div>

            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </section>

    </div>
</div>
@endsection
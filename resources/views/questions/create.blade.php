@extends('layouts.app')

@section('title', '发起提问 - Swift 问答社区')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">发起 Swift 提问</h1>

        <form action="{{ route('questions.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">问题标题</label>
                <input type="text" name="title" required placeholder="如：SwiftUI 6 中 @StateObject 迁移到 @Observable 遇到的闭包捕获警告"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-swift focus:outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Swift 版本</label>
                    <select name="swift_version" class="w-full px-3 py-2 border border-gray-300 rounded-xl">
                        <option value="Swift 6.0">Swift 6.0</option>
                        <option value="Swift 5.10">Swift 5.10</option>
                        <option value="Swift 5.9">Swift 5.9</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">目标系统平台</label>
                    <input type="text" name="target_platform" placeholder="如：iOS 18+ / macOS 15+"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">相关标签</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                    <label class="inline-flex items-center text-xs bg-gray-50 border border-gray-200 px-3 py-1.5 rounded-lg cursor-pointer hover:bg-gray-100">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="mr-1.5 rounded text-swift focus:ring-swift">
                        {{ $tag->name }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    详细描述与代码 (支持 Markdown 语法，可用 ```swift 贴出代码)
                </label>
                <textarea name="content" rows="10" required
                    placeholder="描述你的预期表现、实际报错，以及复现问题的 Swift 代码片段..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl font-mono text-sm focus:ring-2 focus:ring-swift focus:outline-none"></textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('questions.index') }}" class="px-5 py-2 text-sm text-gray-500 hover:text-gray-700">取消</a>
                <button type="submit" class="px-6 py-2 bg-swift hover:bg-orange-600 text-white font-medium rounded-xl shadow-sm">
                    发布提问
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
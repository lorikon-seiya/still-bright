<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Swift Study') - Swift & SwiftUI Study</title>

    <!-- Tailwind CSS CDN -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        swift: '#F05138', // Swift 官方橘红色
                    }
                }
            }
        }
    </script>

    <!-- Highlight.js Swift 代码高亮 (Atom One Dark 主题) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/swift.min.js"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col">

    <!-- 顶部导航栏 -->
    @include('layouts.navigation')

    <!-- 主内容区 -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- 底部 Footer -->
    <footer class="bg-white border-t border-gray-100 mt-20 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">

            <!-- 左侧：版权与技术栈标识 -->
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <span class="font-medium text-gray-700">SwiftHub Blog</span>
                <span class="text-gray-300">•</span>
                <span>&copy; {{ date('Y') }}</span>
                <span class="text-gray-300">•</span>
                <span class="text-xs px-2 py-0.5 bg-gray-100 text-gray-600 rounded-md">Laravel & Swift 6.0</span>
            </div>

            <!-- 右侧：后台入口 (仅具备管理员权限的用户可见) -->
            <div class="flex items-center space-x-4">
                @auth
                {{-- 判断用户是否是管理员（支持 is_admin 字段或 isAdmin() 方法） --}}
                @if (Auth::user()->is_admin || (method_exists(Auth::user(), 'isAdmin') && Auth::user()->isAdmin()))
                <a href="/admin"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-50 hover:bg-gray-100 hover:text-gray-900 border border-gray-200/80 rounded-lg transition-all shadow-sm">
                    <!-- 管理员盾牌图标 -->
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    管理后台
                </a>
                @endif
                @endauth
            </div>

        </div>
    </footer>

    <!-- 初始化 Highlight.js 高亮与代码复制逻辑 -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // 启用代码高亮
            hljs.highlightAll();

            // 为每个代码块添加复制按钮
            document.querySelectorAll('pre code').forEach((codeBlock) => {
                const pre = codeBlock.parentNode;
                pre.classList.add('relative', 'group');

                const button = document.createElement('button');
                button.className = 'absolute top-3 right-3 px-2.5 py-1 text-xs font-mono text-gray-300 bg-gray-800/80 hover:bg-gray-700 rounded border border-gray-600 opacity-0 group-hover:opacity-100 transition-opacity';
                button.innerText = 'Copy';

                button.addEventListener('click', () => {
                    navigator.clipboard.writeText(codeBlock.innerText).then(() => {
                        button.innerText = 'Copied!';
                        button.classList.add('text-green-400');
                        setTimeout(() => {
                            button.innerText = 'Copy';
                            button.classList.remove('text-green-400');
                        }, 2000);
                    });
                });

                pre.appendChild(button);
            });
        });
    </script>
</body>

</html>
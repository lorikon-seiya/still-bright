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
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col">

    <!-- 顶部导航栏 -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50 backdrop-blur-md bg-white/90">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('posts.index') }}" class="flex items-center space-x-3 group">
                <div class="w-9 h-9 bg-swift text-white rounded-xl flex items-center justify-center font-bold text-xl shadow-md group-hover:scale-105 transition-transform">
                    
                </div>
                <span class="font-bold text-xl tracking-tight text-gray-900">Swift<span class="text-swift">Hub</span></span>
            </a>

            <nav class="flex items-center space-x-6">
                <a href="{{ route('posts.index') }}" class="text-sm font-medium text-gray-700 hover:text-swift">首页</a>
                <a href="/admin" class="text-sm font-medium px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">管理后台</a>
            </nav>
        </div>
    </header>

    <!-- 主内容区 -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- 页脚 -->
    <footer class="bg-white border-t border-gray-200 mt-16 py-8">
        <div class="max-w-6xl mx-auto px-4 text-center text-sm text-gray-500">
            <p>© {{ date('Y') }} SwiftHub Blog • Built with Laravel & Swift 6.0</p>
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
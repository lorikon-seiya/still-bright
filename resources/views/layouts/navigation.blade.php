<!-- 顶部导航栏 -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-50 backdrop-blur-md bg-white/90">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('posts.index') }}" class="flex items-center space-x-3 group">
            <div class="w-9 h-9 bg-swift text-white rounded-xl flex items-center justify-center font-bold text-xl shadow-md group-hover:scale-105 transition-transform">
                S
            </div>
            <span class="font-bold text-xl tracking-tight text-gray-900">Swift<span class="text-swift">Hub</span></span>
        </a>

        <!-- 导航菜单与用户操作区 -->
        <nav class="flex items-center space-x-5">
            <a href="{{ route('posts.index') }}" class="text-sm font-medium text-gray-700 hover:text-swift transition-colors">
                Home
            </a>
            <!-- 加上这一行 -->
            <a href="{{ route('questions.index') }}" class="text-sm font-medium text-gray-700 hover:text-swift">Questions</a>

            <!-- 权限与认证状态判断 -->
            @if (Auth::user())
            {{-- 1. 已登录状态 (下拉菜单) --}}
            <div class="relative pl-2 border-l border-gray-200" x-data="{ open: false }">
                <!-- 下拉触发按钮 -->
                <button @click="open = !open"
                    type="button"
                    class="flex items-center space-x-2 py-1.5 px-3 rounded-xl hover:bg-gray-100 text-sm font-medium text-gray-700 transition-colors focus:outline-none">

                    <!-- 用户名 -->
                    <span>{{ Auth::user()->name }}</span>

                    <!-- 下拉小箭头 (展开时自动旋转) -->
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                        :class="{ 'rotate-180': open }"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- 下拉菜单浮层 -->
                <div x-show="open"
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-xl shadow-gray-200/60 border border-gray-100 py-1.5 z-50 divide-y divide-gray-100"
                    style="display: none;">

                    <!-- 用户简要信息区 -->
                    <div class="px-4 py-2.5">
                        <p class="text-xs text-gray-400">now login</p>
                        <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <!-- 操作链接列表 -->
                    <div class="py-1">
                        @if (Route::has('profile.edit'))
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-swift transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile
                        </a>
                        @endif
                    </div>

                    <!-- 登出按钮 -->
                    <div class="py-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors text-left font-medium">
                                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            {{-- 2. 未登录状态 (保持之前设计) --}}
            <div class="flex items-center space-x-3 pl-2 border-l border-gray-200">
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-swift transition-colors">
                    Login
                </a>
            </div>
            @endif
        </nav>
    </div>
</header>
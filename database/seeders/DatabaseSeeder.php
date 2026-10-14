<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. 自动创建后台管理员账号 (如果不存在则创建)
        User::firstOrCreate(
            ['email' => 'mio@mio.mio'], // 登录邮箱
            [
                'name' => 'mio',
                'password' => Hash::make('123456789'), // 登录密码 (设为你喜欢的密码)
            ]
        );

        // 1. 先创建 4 个经典分类
        $categories = collect([
            ['name' => 'SwiftUI 实战', 'slug' => 'swiftui', 'color' => '#007AFF'],
            ['name' => 'Swift 语言基础', 'slug' => 'swift-basics', 'color' => '#FF9500'],
            ['name' => '并发编程', 'slug' => 'concurrency', 'color' => '#AF52DE'],
            ['name' => 'SwiftData & 持久化', 'slug' => 'swiftdata', 'color' => '#34C759'],
        ])->map(fn($cat) => Category::create($cat));

        // 2. 创建 5 个常用标签
        $tags = collect([
            ['name' => '@Observable', 'slug' => 'observable'],
            ['name' => 'Async/Await', 'slug' => 'async-await'],
            ['name' => 'Actor', 'slug' => 'actor'],
            ['name' => 'Macros 宏', 'slug' => 'macros'],
            ['name' => 'iOS 18+', 'slug' => 'ios-18'],
        ])->map(fn($tag) => Tag::create($tag));

        // 3. 使用 Factory 批量生成 14 篇带随机 Swift 代码的文章
        Post::factory()->count(14)->create()->each(function ($post) use ($tags) {
            // 给每篇文章随机关联 1 ~ 3 个标签
            $post->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
        });
    }
}

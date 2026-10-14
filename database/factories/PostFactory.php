<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        // 随机 Swift/iOS 技术标题池
        $titles = [
            'SwiftUI 核心：全方位掌握 NavigationStack 动态路由机制',
            'Swift 6 宏 (Macros) 开发：从零实现自定义 @AutoInit 宏',
            'SwiftData 进阶：如何优雅处理多表关联与 Data Migration',
            'Swift 中的 Structured Concurrency 结构化并发实战',
            'CoreAnimation 与 SwiftUI 组合动画性能调优指南',
            '使用 Swift Package Manager (SPM) 打造模块化 iOS 架构',
            'iOS 18 新 API 探索：SwiftUI 中的 MeshGradient 网格渐变',
            'Swift 中的 Value Types vs Reference Types 深度性能对比',
            'Combine 响应式编程迁移到 Swift Concurrency 指南',
            'Swift 中的 Pattern Matching 模式匹配高级技巧',
            'SwiftUI 视图渲染性能优化：规避重复 Body 刷新',
            'Swift 6 严格并发检查：Task 与 Actor 实战解析',
            'iOS 中的 CoreData 到 SwiftData 迁移策略总结',
            'Swift 中的 Result Builder 语法糖原理全解析',
        ];

        // 随机 Swift 代码片段池
        $swiftCodes = [
            "```swift\nimport SwiftUI\n\nstruct CustomButton: View {\n    let title: String\n    let action: () -> Void\n    \n    var body: some View {\n        Button(action: action) {\n            Text(title)\n                .font(.headline)\n                .padding()\n                .background(Color.blue)\n                .foregroundColor(.white)\n                .cornerRadius(10)\n        }\n    }\n}\n```",
            "```swift\nimport Foundation\n\nactor SafeDataStore {\n    private var cache: [String: Any] = [:]\n    \n    func set(_ value: Any, forKey key: String) {\n        cache[key] = value\n    }\n    \n    func get(forKey key: String) -> Any? {\n        return cache[key]\n    }\n}\n```",
            "```swift\nimport SwiftData\n\n@Model\nfinal class Article {\n    var title: String\n    var createdAt: Date\n    \n    init(title: String, createdAt: Date = Date()) {\n        self.title = title\n        self.createdAt = createdAt\n    }\n}\n```",
        ];

        $title = $this->faker->unique()->randomElement($titles);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(4),
            'summary' => $this->faker->paragraph(2),
            'content' => "本文主要探讨的是 **{$title}** 的核心技术细节与实战要点。\n\n### 核心原理解析\n\n" . $this->faker->paragraph(3) . "\n\n### Swift 示例代码\n\n" . $this->faker->randomElement($swiftCodes) . "\n\n### 总结与建议\n\n" . $this->faker->paragraph(2),
            'cover_image' => null,
            'swift_version' => $this->faker->randomElement(['Swift 6.0', 'Swift 5.10', 'Swift 5.9']),
            'target_platform' => $this->faker->randomElement(['iOS 18+ / macOS 15+', 'iOS 17+ / macOS 14+', '跨平台']),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'is_published' => true,
            'published_at' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'views_count' => $this->faker->numberBetween(20, 2000),
        ];
    }
}

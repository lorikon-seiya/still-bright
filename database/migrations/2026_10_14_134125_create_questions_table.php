<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');                          // 提问标题 (如: SwiftUI 中 @Binding 如何跨多层传递?)
            $table->string('slug')->unique();                 // URL 别名
            $table->longText('content');                     // 问题的详细描述与报错代码 (Markdown)

            // 关联提问者
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // 采纳的最佳答案 ID（可为空）
            $table->unsignedBigInteger('best_answer_id')->nullable();

            // Swift 特色字段
            $table->string('swift_version')->default('Swift 6.0'); // 提问涉及的 Swift 版本
            $table->string('target_platform')->nullable();         // 目标系统 (如 iOS 18, macOS 15)

            // 统计数据
            $table->unsignedInteger('views_count')->default(0);    // 浏览量
            $table->unsignedInteger('answers_count')->default(0);  // 回答数缓存
            $table->boolean('is_resolved')->default(false);        // 是否已解决

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};

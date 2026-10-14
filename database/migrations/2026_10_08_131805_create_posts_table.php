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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');                     // 文章标题
            $table->string('slug')->unique();            // 文章 URL 别名
            $table->text('summary')->nullable();        // 文章摘要/简介
            $table->longText('content');                // Markdown 正文内容
            $table->string('cover_image')->nullable();   // 文章封面图地址

            // 苹果开发特色字段
            $table->string('swift_version')->default('Swift 6'); // Swift 版本 (如：Swift 6.0, Swift 5.10)
            $table->string('target_platform')->nullable();       // 目标平台 (如：iOS 18+, macOS 15+)
            // 关联分类外键
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            $table->boolean('is_published')->default(false);     // 是否发布
            $table->timestamp('published_at')->nullable();       // 发布时间
            $table->unsignedInteger('views_count')->default(0);  // 阅读量统计
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

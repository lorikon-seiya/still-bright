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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // 分类名称（如：SwiftUI、Swift 基础、iOS 实战）
            $table->string('slug')->unique();    // URL 别名（如：swiftui, swift-basics）
            $table->string('description')->nullable(); // 分类简介
            $table->string('color', 7)->default('#007AFF'); // 分类主题色（默认 Apple 蓝）
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete(); // 属于哪个问题
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();     // 谁回答的
            $table->longText('content');                                        // 回答内容 (支持 Swift 代码高亮)
            $table->boolean('is_best')->default(false);                         // 是否被采纳为最佳答案
            $table->unsignedInteger('votes_count')->default(0);                 // 点赞/好评数
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'best_answer_id',
        'swift_version',
        'target_platform',
        'views_count',
        'answers_count',
        'is_resolved',
    ];

    protected $casts = [
        'is_resolved' => 'boolean',
    ];

    // 提问者
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // 该问题下的所有回答
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    // 采纳的最佳答案
    public function bestAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'best_answer_id');
    }

    // 关联的标签 (如: @Binding, SwiftUI)
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}

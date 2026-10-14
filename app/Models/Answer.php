<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'user_id',
        'content',
        'is_best',
        'votes_count',
    ];

    protected $casts = [
        'is_best' => 'boolean',
    ];

    // 回答所属的问题
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    // 回答者
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use App\Services\MarkdownService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    // 问答广场列表页
    public function index(Request $request)
    {
        $query = Question::with(['user', 'tags', 'answers'])
            ->latest();

        // 筛选：待解答 vs 已解决
        if ($request->filter === 'unsolved') {
            $query->where('is_resolved', false);
        } elseif ($request->filter === 'solved') {
            $query->where('is_resolved', true);
        }

        // 搜索功能
        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        $questions = $query->paginate(12)->withQueryString();
        $tags = Tag::all();

        return view('questions.index', compact('questions', 'tags'));
    }

    // 显示提问表单页面（需要登录）
    public function create()
    {
        $tags = Tag::all();
        return view('questions.create', compact('tags'));
    }

    // 保存提交的新问题
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'required|string|min:15',
            'swift_version' => 'required|string',
            'target_platform' => 'nullable|string',
            'tags' => 'nullable|array',
        ]);

        $question = Question::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'swift_version' => $validated['swift_version'],
            'target_platform' => $validated['target_platform'],
        ]);

        if (!empty($validated['tags'])) {
            $question->tags()->sync($validated['tags']);
        }

        return redirect()->route('questions.show', $question->slug)
            ->with('success', '问题发布成功！');
    }

    // 问题详情页
    public function show(string $slug)
    {
        $question = Question::with(['user', 'tags', 'answers.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        // 浏览量增加
        $question->increment('views_count');

        // 将问题的 Markdown 转换为 HTML
        $questionHtml = MarkdownService::parse($question->content);

        // 整理回答：如果已有最佳答案，将最佳答案置顶展示
        $answers = $question->answers->sortByDesc('is_best');

        return view('questions.show', compact('question', 'questionHtml', 'answers'));
    }
}

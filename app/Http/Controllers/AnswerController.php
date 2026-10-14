x<?php

    namespace App\Http\Controllers;

    use App\Models\Answer;
    use App\Models\Question;
    use Illuminate\Http\Request;

    class AnswerController extends Controller
    {
        // 提交新回答
        public function store(Request $request, Question $question)
        {
            $request->validate([
                'content' => 'required|string|min:6',
            ]);

            $question->answers()->create([
                'user_id' => auth()->id(),
                'content' => $request->content,
            ]);

            // 更新问题下的回答计数
            $question->increment('answers_count');

            return back()->with('success', '回答已提交！');
        }

        // 提问者采纳“最佳答案”
        public function markBest(Question $question, Answer $answer)
        {
            // 鉴权：只有提问者本人才可以采纳最佳答案
            if (auth()->id() !== $question->user_id) {
                abort(403, '只有提问者本人才能采纳最佳答案');
            }

            // 取消该问题之前所有的最佳答案
            $question->answers()->update(['is_best' => false]);

            // 将当前回答设为最佳答案
            $answer->update(['is_best' => true]);

            // 更新问题状态为“已解决”
            $question->update([
                'is_resolved' => true,
                'best_answer_id' => $answer->id,
            ]);

            return back()->with('success', '已采纳该回答为最佳答案！');
        }
    }

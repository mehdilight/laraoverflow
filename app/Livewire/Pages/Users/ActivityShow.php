<?php

namespace App\Livewire\Pages\Users;

use App\Models\Tag;
use App\Models\User;
use Livewire\Component;

class ActivityShow extends Component
{
    public User $user;
    public int $answersCount;
    public int $questionsCount;

    public function mount()
    {
        $this->answersCount = $this->user->answers()->count();
        $this->questionsCount = $this->user->questions()->count();
    }

    public function render()
    {
        $latestQuestions = $this->user->questions()->latest()->paginate();
        $topTags = Tag::query()
            ->select('tags.*')
            ->join('question_tag', 'tags.id', '=', 'question_tag.tag_id')
            ->join('questions', 'questions.id', '=', 'question_tag.question_id')
            ->where('questions.user_id', '=', $this->user->id)
            ->distinct()
            ->withCount([
                'questions' => function (\Illuminate\Database\Eloquent\Builder $query) {
                    $query->where('user_id', $this->user->id);
                }
            ])
            ->paginate();

        $view = view('livewire.pages.users.activity-show', [
            'topTags' => $topTags ,
            'latestQuestions' => $latestQuestions
        ]);

        $view->layout('components.layouts.app', [
            'title' => 'Activity'
        ]);

        return $view;
    }
}

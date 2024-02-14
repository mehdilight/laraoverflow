<?php

namespace App\Livewire\Global;

use App\Models\Question;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Search extends Component
{
    public string $searchTerm = '';

    #[Computed]
    public function results()
    {
        if (!$this->searchTerm) return collect([]);

        return Question::query()
            ->where('title', 'like', sprintf('%%%s%%', $this->searchTerm))
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.global.search');
    }
}

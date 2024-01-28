<?php

namespace App\Livewire\Pages\Tags;

use Livewire\Attributes\Url;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url(keep: true, history: true)]
    public string $search = '';

    public function render()
    {
        $tags = Tag::query()
            ->when($this->search, function (Builder $query) {
                $query->where('name', 'like', sprintf('%%%s%%', $this->search));
            })
            ->paginate();

        $this->resetPage();

        return view('livewire.pages.tags.index', [
            'tags' => $tags
        ]);
    }
}

<?php

namespace App\Livewire\Pages\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url(keep: true, history: true)]
    public string $search = '';

    public function render()
    {
        $users = User::query()
            ->when($this->search, function (Builder $query) {
                $query->where('username', 'like', sprintf('%%%s%%', $this->search));
            })
            ->paginate();

        $view = view('livewire.pages.users.index', [
            'users' => $users
        ]);

        $view->layout('components.layouts.app', [
            'title' => 'Users'
        ]);

        $this->resetPage();

        return $view;
    }
}

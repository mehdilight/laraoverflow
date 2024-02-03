<?php

namespace App\Livewire\Pages\Users;

use App\Models\Bookmark;
use App\Models\BookmarkList;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class BookmarkIndex extends Component
{
    use WithPagination;

    public User $user;

    #[Url(as: 'list_name', keep: true, history: true)]
    public string $listName = 'default';

    public bool $isCreateBookmarkModalOpen = false;

    public string $tabName = 'bookmarks';

    public function openModal()
    {
        $this->isCreateBookmarkModalOpen = true;
    }

    #[On('bookmark-list-modal-should-close')]
    #[On('bookmark-list-created')]
    public function closeModal()
    {
        $this->isCreateBookmarkModalOpen = false;
    }

    public function changeBookmarkList(string $listName)
    {
        $this->listName = $listName;
    }

    #[Computed(persist : true)]
    public function bookmarkLists()
    {
        return $bookmarkLists = BookmarkList::query()
            ->whereNot('name', 'default')
            ->get();
    }

    #[Computed]
    public function bookmarksPaginated()
    {
        $list = BookmarkList::query()
            ->whereBelongsTo($this->user)
            ->where('name', $this->listName)
            ->first();

        return Bookmark::query()
            ->where('bookmark_list_id', $list->id)
            ->with(
                [
                    'question.user',
                    'question.tags',
                    'answer',
                ]
            )
            ->paginate(2);
    }

    public function render()
    {
        $view = view('livewire.pages.users.bookmark-index');

        $view->layout('components.layouts.app', [
            'title' => 'Users'
        ]);

        return $view;
    }
}

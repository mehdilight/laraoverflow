<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateBookmarkList extends Component
{
    public User $user;

    #[Validate('required')]
    public string $name = '';

    public function closeModal()
    {
        $this->dispatch('bookmark-list-modal-should-close');
    }

    public function store()
    {
        $validated = $this->validate();
        $this->user->bookmarkLists()->create($validated);

        $this->dispatch('bookmark-list-created');
    }

    public function render()
    {
        return view('livewire.components.create-bookmark-list');
    }
}

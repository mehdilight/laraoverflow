<?php

namespace App\Livewire\Pages\Users;

use App\Models\User;
use Livewire\Component;

class BookmarkIndex extends Component
{
    public User $user;

    public function render()
    {
        $view = view('livewire.pages.users.bookmark-index');

        $view->layout('components.layouts.app', [
            'title' => 'Users'
        ]);

        return $view;
    }
}

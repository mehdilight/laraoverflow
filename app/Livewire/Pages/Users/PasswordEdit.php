<?php

namespace App\Livewire\Pages\Users;

use App\Models\User;
use Livewire\Component;

class PasswordEdit extends Component
{
    public User $user;

    public function render()
    {
        $view = view('livewire.pages.users.password-edit');

        $view->layout('components.layouts.app', [
            'title' => 'Users'
        ]);

        return $view;
    }
}

<?php

namespace App\Livewire\Pages\Users;

use App\Models\User;
use Livewire\Component;

class ProfileShow extends Component
{
    public User $user;

    public function render()
    {
        $view = view('livewire.pages.users.profile-show');

        $view->layout('components.layouts.app', [
            'title' => 'Users'
        ]);

        return $view;
    }
}

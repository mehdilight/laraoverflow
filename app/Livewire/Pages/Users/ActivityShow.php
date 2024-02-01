<?php

namespace App\Livewire\Pages\Users;

use App\Models\User;
use Livewire\Component;

class ActivityShow extends Component
{
    public User $user;

    public function render()
    {
        $view = view('livewire.pages.users.activity-show');

        $view->layout('components.layouts.app', [
            'title' => 'Activity'
        ]);

        return $view;
    }
}

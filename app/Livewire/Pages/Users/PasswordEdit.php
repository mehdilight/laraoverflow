<?php

namespace App\Livewire\Pages\Users;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PasswordEdit extends Component
{
    public User $user;

    #[Validate('required')]
    public string $current_password = '';

    #[Validate('required|confirmed')]
    public string $new_password = '';

    public string $new_password_confirmation = '';

    public function boot()
    {
        if (!Gate::allows('update-profile', $this->user)) {
            abort(404);
        }
    }

    public function updatePassword()
    {
        $validated = $this->validate();
        $currentPassword = Arr::get($validated, 'current_password');
        $newPassword = Arr::get($validated, 'new_password');

        if (!Hash::check($currentPassword, $this->user->getAuthPassword())) {
            return $this->redirect(route('users.profile.show', $this->user));
        }

        $this->user->update(
            [
                'password' => Hash::make($newPassword)
            ]
        );

        return $this->redirect(route('users.profile.show', $this->user));
    }

    public function render()
    {
        $view = view('livewire.pages.users.password-edit');

        $view->layout('components.layouts.app', [
            'title' => 'Users'
        ]);

        return $view;
    }
}

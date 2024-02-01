<?php

namespace App\Livewire\Pages\Users;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProfileShow extends Component
{
    use AuthorizesRequests;

    public User $user;

    #[Validate('required')]
    public string $name;

    #[Validate('required')]
    public string $username;

    #[Validate('nullable')]
    public ?string $job_title;

    #[Validate('nullable')]
    public ?string $location;

    #[Validate('nullable')]
    public ?string $website_url;

    #[Validate('nullable|max:255')]
    public ?string $bio;

    public function boot()
    {
        if (!Gate::allows('update-profile', $this->user)) {
            abort(404);
        }

        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->job_title = $this->user->job_title;
        $this->location = $this->user->location;
        $this->website_url = $this->user->website_url;
        $this->bio = $this->user->bio;
    }

    public function save()
    {
        if (!Gate::allows('update-profile', $this->user)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $validatedUserInfo = $this->validate();

        $this->user->update($validatedUserInfo);

        return $this->redirect(route('users.password.edit', $this->user), true);
    }

    public function render()
    {
        $view = view('livewire.pages.users.profile-show');

        $view->layout('components.layouts.app', [
            'title' => 'Users'
        ]);

        return $view;
    }
}

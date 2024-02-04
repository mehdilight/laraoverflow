<?php

namespace App\Livewire\Pages\Users;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\Response;

class ProfileShow extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;


    public User $user;

    #[Validate('nullable|image|max:1024')] // 1MB Max
    public $profileImage;

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
        $this->profileImagePath = $this->user->profile_photo_url;
    }

    public function save()
    {
        if (!Gate::allows('update-profile', $this->user)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        if ($this->profileImage){
            $photoPath = $this->profileImage->storePublicly('profile-photos', [
                'disk' => 'public'
            ]);
        }

        $validatedUserInfo = $this->validate();

        $this->user->update(
            array_merge(
                Arr::only($validatedUserInfo, [
                    'name',
                    'username',
                    'job_title',
                    'location',
                    'website_url',
                    'bio'
                ]),
                [
                    'profile_photo_path' => $this->profileImage ? $photoPath : null
                ]
            )
        );

        return $this->redirect(route('users.profile.show', $this->user));
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

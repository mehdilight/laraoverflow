<div>
  <header class="pt-10 pb-6">
    <div class="flex space-x-3 mb-3">
      <img class="rounded-lg block w-28 h-28"
           src="https://laracasts.nyc3.digitaloceanspaces.com/members/avatars/1770.jpg?v=20"
           alt="">
      <div>
        <h1 class="text-xl font-semibold mb-3">
          {{ $user->username }}
        </h1>
        <p class="text-sm">
          Owner at Laracasts
        </p>
        <p class="text-sm">
          Member Since {{ $user->created_at->diffForHumans() }}
        </p>
        <p class="flex items-center space-x-2 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
          </svg>
          <span>
            Lives In Winter Park, FL
          </span>
        </p>
      </div>
    </div>
    <div class="btn-group mt-6" role="group">
      <a
        wire:navigate
        href="{{ route('users.profile.show', $user) }}"
        class="btn-group-item {{ \Illuminate\Support\Facades\Route::is('users.profile.show') ? 'active' : '' }}">
        Profile
      </a>
      <a
        wire:navigate
        href="{{ route('users.password.edit', $user) }}"
        class="btn-group-item {{ \Illuminate\Support\Facades\Route::is('users.password.edit') ? 'active' : '' }}">
        Password
      </a>
      <a
        wire:navigate
        href="{{ route('users.bookmark.index', $user) }}"
        class="btn-group-item {{ \Illuminate\Support\Facades\Route::is('users.bookmark.index') ? 'active' : '' }}">
        Bookmark
      </a>
    </div>
  </header>
  <main>
    <header class="mb-3">
      <h2 class="text-lg font-semibold">
        Profile
      </h2>
      <p class="text-sm text-gray-700">
        Update your profile and personal details here
      </p>
    </header>
    <form>
      <div class="grid grid-cols-3 gap-2">
        <div>
          <label for="full_name" class="label">Full name</label>
          <input type="text" class="input" name="full_name" id="full_name">
        </div>
        <div>
          <label for="username" class="label">Username</label>
          <input type="text" class="input" name="username" id="username">
        </div>
        <div>
          <label for="job_title" class="label">Job title</label>
          <input type="text" class="input" name="job_title" id="job_title">
        </div>
        <div>
          <label for="location" class="label">Location</label>
          <input type="text" class="input" name="email" id="location">
        </div>
        <div>
          <label for="interests" class="label">Interests</label>
          <input type="text" class="input" name="interests" id="interests">
        </div>
        <div>
          <label for="website" class="label">Your website</label>
          <input type="text" class="input" name="website" id="website">
        </div>
        <div class="col-span-3">
          <label for="bio" class="label">About me</label>
          <textarea name="bio" id="bio" class="input resize-none"></textarea>
        </div>
      </div>
      <div class="mt-4 flex justify-end space-x-3">
        <button class="btn btn-primary" type="submit">
          Save changes
        </button>
        <a class="btn btn-primary-outlined" href="{{route('questions.index')}}">
          Cancel
        </a>
      </div>
    </form>
  </main>
</div>

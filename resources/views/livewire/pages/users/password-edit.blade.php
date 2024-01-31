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
        Update your password here
      </p>
    </header>
    <form>
      <div class="space-y-2 max-w-md">
        <div>
          <label for="current_password" class="label">Current password</label>
          <input type="password" class="input" name="current_password" id="current_password">
        </div>
        <div>
          <label for="new_password" class="label">New password</label>
          <input type="password" class="input" name="new_password" id="new_password">
        </div>
        <div>
          <label for="new_password_confirmation" class="label">Confirm new password</label>
          <input type="password" class="input" name="new_password_confirmation" id="new_password_confirmation">
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

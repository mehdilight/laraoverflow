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
        href="{{ route('users.activity.show', $user) }}"
        class="btn-group-item {{ $currentTab === 'activity' ? 'active' : '' }}">
        Activity
      </a>
      @if ($user->is_authenticated)
        <a
          wire:navigate
          href="{{ route('users.profile.show', $user) }}"
          class="btn-group-item {{ $currentTab === 'profile' ? 'active' : '' }}">
          Profile
        </a>
        <a
          wire:navigate
          href="{{ route('users.password.edit', $user) }}"
          class="btn-group-item {{ $currentTab === 'password' ? 'active' : '' }}">
          Password
        </a>
        <a
          wire:navigate
          href="{{ route('users.bookmark.index', $user) }}"
          class="btn-group-item {{ $currentTab === 'bookmarks' ? 'active' : '' }}">
          Bookmark
        </a>
      @endif
    </div>
  </header>
  <main>
    {{ $slot }}
  </main>
</div>

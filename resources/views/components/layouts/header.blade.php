@php
$user =  \Illuminate\Support\Facades\Auth::user();
@endphp

<header
  class="border-solid border-b border-gray-200 sticky top-0 right-0 bg-white z-[60] before:content-[''] before:absolute before:w-full before:h-[4px] before:bg-violet-500 ">
  <div class="main-container mx-auto flex px-4 py-4 gap-4 md:pr-10">
    <button class="pr-2 md:hidden" @click="isSidebarClosed=false">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
      </svg>
    </button>
    <a href="{{ route('questions.index') }}">
      <x-app-logo />
    </a>
    <livewire:global.search />
    <div class="flex-grow flex items-center justify-end space-x-3">
      @guest
        <ul class="flex items-center space-x-2 md:space-x-3">
          <li>
            <a href="{{ route('auth.register.create') }}" class="btn btn-primary-outlined text-xs md:text-sm">
              Signup
            </a>
          </li>
          <li>
            <a href="{{ route('auth.login.create') }}" class="btn btn-primary text-xs md:text-sm">
              Login
            </a>
          </li>
        </ul>
      @endguest
      @auth
        <a class="inline-block" href="{{ route('users.profile.show', $user) }}">
          <img class="rounded w-8 h-8" src="{{ $user->profile_photo_url }}" alt="">
        </a>
      @endauth
    </div>
  </div>
</header>

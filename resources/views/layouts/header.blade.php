<header
  class="border-solid border-b border-gray-200 sticky top-0 right-0 bg-white z-10 relative before:content-[''] before:absolute before:w-full before:h-[4px] before:bg-violet-500 ">
  <div class="main-container mx-auto flex px-4 py-4 space-x-4">
    <a href="{{ route('questions.index') }}">
      <x-app-logo />
    </a>
    <form>
      <div class="relative">
        <label for="search" class="absolute top-0 bottom-0 left-0 flex items-center px-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
          </svg>
        </label>
        <input placeholder="Search" type="search" id="search"
               class="text-sm border-solid border-gray-300 rounded pl-8 focus:outline-none focus:ring focus:ring-violet-200 focus:border-gray-300">
      </div>
    </form>
    @guest
      <ul class="flex-grow flex justify-end flex items-center space-x-3">
        <li>
          <a href="{{ route('auth.register.create') }}" class="btn btn-primary-outlined">
            Signup
          </a>
        </li>
        <li>
          <a href="{{ route('auth.login.create') }}" class="btn btn-primary">
            Login
          </a>
        </li>
      </ul>
    @endguest
    @auth

    @endauth
  </div>
</header>

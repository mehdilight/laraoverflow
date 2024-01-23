<header
  class="border-solid border-b border-gray-200 sticky top-0 right-0 bg-white z-10 h-[63px] relative before:content-[''] before:absolute before:w-full before:h-[3px] before:bg-orange-400 ">
  <div class="main-container mx-auto flex px-4 py-3 space-x-4">
    <a href="{{ route('questions.index') }}">
      <svg aria-hidden="true" width="32" height="37" viewBox="0 0 32 37">
        <path d="M26 33v-9h4v13H0V24h4v9h22Z" fill="#BCBBBB"></path>
        <path
          d="m21.5 0-2.7 2 9.9 13.3 2.7-2L21.5 0ZM26 18.4 13.3 7.8l2.1-2.5 12.7 10.6-2.1 2.5ZM9.1 15.2l15 7 1.4-3-15-7-1.4 3Zm14 10.79.68-2.95-16.1-3.35L7 23l16.1 2.99ZM23 30H7v-3h16v3Z"
          fill="#F48024"></path>
      </svg>
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
               class="text-sm border-solid border-gray-300 rounded pl-8 focus:outline-none focus:ring focus:ring-orange-200 focus:border-gray-300">
      </div>
    </form>
    @guest
      <ul class="flex-grow flex justify-end flex items-center space-x-3">
        <li>
          <a href="{{ route('auth.register.create') }}" class="btn btn-primary">
            Signup
          </a>
        </li>
        <li>
          <a href="{{ route('auth.login.create') }}" class="btn btn-secondary">
            Login
          </a>
        </li>
      </ul>
    @endguest
    @auth
      
    @endauth
  </div>
</header>

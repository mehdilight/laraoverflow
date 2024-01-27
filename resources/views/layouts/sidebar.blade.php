<aside class="bg-white border-r border-solid border-gray-200 w-[200px] sticky z-10 top-[63px] flex-shrink-0"
       style="height: calc(100vh - 64px)">
  <ul class="mt-4">
    <li>
      <a
        class="flex items-center space-x-1 px-4 py-2 text-sm {{ \Illuminate\Support\Facades\Route::is('questions.*') ? 'bg-orange-200 font-bold' : '' }}"
        href="{{ route('questions.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/>
        </svg>
        <span>
          Questions
        </span>
      </a>
    </li>
    <li>
      <a
        class="flex items-center space-x-1 px-4 py-2 text-sm {{ \Illuminate\Support\Facades\Route::is('tags.index') ? 'bg-orange-200 font-bold' : '' }}"
        href="{{ route('tags.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5"/>
        </svg>
        <span>
          Tags
        </span>
      </a>
    </li>
    <li>
      <a
        class="flex items-center space-x-1 px-4 py-2 text-sm {{ \Illuminate\Support\Facades\Route::is('users.index') ? 'bg-orange-200 font-bold' : '' }}"
        href="{{ route('users.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
        </svg>
        <span>
          Users
        </span>
      </a>
    </li>
  </ul>
</aside>

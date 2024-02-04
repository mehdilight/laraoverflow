<aside class="bg-white w-[200px] sticky z-10 top-[71px] flex-shrink-0"
       style="height: calc(100vh - 64px)">
  <ul class="mt-4">
    <li>
      <a
        class="flex items-center space-x-2 px-4 py-2 text-sm rounded-sm {{ \Illuminate\Support\Facades\Route::is('questions.*') ? "bg-violet-100 relative after:bg-violet-400 after:content-[''] after:w-1 after:rounded after:h-full after:block after:absolute after:right-0" : "" }}"
        href="{{ route('questions.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>
        <span>
          Questions
        </span>
      </a>
    </li>
    <li>
      <a
        class="flex items-center space-x-2 px-4 py-2 text-sm rounded-sm {{ \Illuminate\Support\Facades\Route::is('tags.index') ? "bg-violet-100 relative after:bg-violet-400 after:content-[''] after:w-1 after:rounded after:h-full after:block after:absolute after:right-0" : '' }}"
        href="{{ route('tags.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-6 h-6">
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
        class="flex items-center space-x-2 px-4 py-2 text-sm rounded-sm {{ \Illuminate\Support\Facades\Route::is('users.*') ? "bg-violet-100 relative after:bg-violet-400 after:content-[''] after:w-1 after:rounded after:h-full after:block after:absolute after:right-0" : '' }}"
        href="{{ route('users.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-6 h-6">
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

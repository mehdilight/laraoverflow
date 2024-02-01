<x-blocks.users.user-dashboard
  :user="$user"
  currentTab="bookmarks"
>
  <main class="flex space-x-4">
    <aside class="w-52 flex-shrink-0">
      <nav class="w-full">
        <ul class="text-sm space-y-2">
          <li>
            <a
              href="#"
              wire:click.prevent="changeBookmarkList('default')"
              @class(['px-4 py-1 text-gray-900 block rounded border border-solid border-transparent hover:border-gray-200 hover:bg-gray-200', 'border border-solid border-violet-200 bg-violet-100 hover:bg-violet-100 focus:bg-violet-100 text-violet-800 font-medium' => $listName === 'default' ])
            >
              For later
            </a>
          </li>
          <li>
            <div class="flex justify-between items-center px-4 py-1 font-bold">
              <span>
                My Lists
              </span>

              <button type="button" wire:click="openModal">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
              </button>
            </div>
            <ul class="space-y-1">
              @foreach($this->bookmarkLists as $bookmarkList)
                <li>
                  <a
                    wire:click.prevent="changeBookmarkList('{{ $bookmarkList->name }}')"
                    href="#"
                    @class(['px-4 py-1 text-gray-900 block rounded border border-solid border-transparent hover:border-gray-200 hover:bg-gray-200', 'border border-solid border-violet-200 bg-violet-100 hover:bg-violet-100 focus:bg-violet-100 text-violet-800 font-medium' => $listName === $bookmarkList->name ])
                  >
                    {{ $bookmarkList->name }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        </ul>
      </nav>
    </aside>
    <section class="flex-grow space-y-4">
      @foreach($this->bookmarksPaginated as $bookmark)
        <x-blocks.users.bookmark-card
          :bookmark="$bookmark"
        />
      @endforeach
    </section>
  </main>
  @if ($isCreateBookmarkModalOpen)
    <livewire:components.create-bookmark-list :user="$user"/>
  @endif
</x-blocks.users.user-dashboard>

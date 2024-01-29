<section class="p-4">
  <form class="mb-4">
    <div class="relative">
      <label for="search_tags" class="absolute top-0 bottom-0 left-0 flex items-center px-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
        </svg>
      </label>
      <input
        wire:model.live.debounce.250ms="search"
        placeholder="Search"
        type="search"
        id="search_tags"
        class="text-sm border-solid border-gray-300 rounded pl-8 focus:outline-none focus:ring focus:ring-violet-200 focus:border-gray-300">
    </div>
  </form>
  <div class="grid grid-cols-4 gap-2">
    @foreach($tags as $tag)
      <section class="p-4 rounded-lg shadow-lg bg-white">
        <x-tag.badge :tag="$tag"/>
        <p class="text-xs text-gray-500 mt-4">
          {{ \Illuminate\Support\Str::limit($tag->description, 141) }}
        </p>
      </section>
    @endforeach
  </div>
  <div class="py-4">
    {{ $tags->withQueryString()->links('vendor.livewire.tailwind') }}
  </div>
</section>

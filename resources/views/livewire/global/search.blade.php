<div class="relative" x-data="{resultsDisplayed: false}" @click.outside="resultsDisplayed = false">
  <form class="block md:block">
    <div class="relative">
      <label for="search" class="absolute top-0 bottom-0 left-0 flex items-center px-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
        </svg>
      </label>
      <input
        placeholder="Search"
        type="search"
        id="search"
        class="w-full text-sm border-solid border-gray-300 rounded pl-8 focus:outline-none focus:ring focus:ring-violet-200 focus:border-gray-300"
        wire:model.live="searchTerm"
        @focus="resultsDisplayed = true"
      >
    </div>
  </form>
  @if ($this->results->isNotEmpty())
    <section class="absolute top-full rounded left-0 right-0 p-2 z-[100] bg-white shadow w-[300px]" x-show="resultsDisplayed">
      @foreach($this->results as $question)
        <a class="text-xs text-slate-800 block hover:bg-violet-100 px-2 py-1 rounded" href="{{ route('questions.show', [$question->id, $question->slug]) }}">
          {{ $question->title }}
        </a>
      @endforeach
    </section>
  @endif
</div>

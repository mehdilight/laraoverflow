<x-layouts.app>
  <x-slot:title>
    Frequent questions - Laraoverflow
  </x-slot:title>
  <header class="space-y-4 mb-4 md:mb-10">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">
        All Questions
      </h1>
      <a class="btn btn-primary-outlined text-xs md:hidden" href="{{ route('questions.create') }}">
        Ask Question
      </a>
    </div>
    <div class="md:flex justify-between items-center">
      @php
        $sortFilter = $filters->findByName('sort');
      @endphp
      <div class="btn-group" role="group">
        <a href="?filters[sort]=most_votes"
           class="btn-group-item {{ $sortFilter?->getValue() === 'most_votes' ? 'active' : '' }}">
          Most votes
        </a>
        <a href="?filters[sort]=newest"
           class="btn-group-item {{ $sortFilter?->getValue() === 'newest' ? 'active' : '' }}">
          Newest
        </a>
        <a href="?filters[sort]=unanswered"
           class="btn-group-item {{ $sortFilter?->getValue() === 'unanswered' ? 'active' : '' }}">
          Unanswered
        </a>
      </div>
      <a class="hidden md:block btn btn-primary-outlined" href="{{ route('questions.create') }}">
        Ask Question
      </a>
    </div>
  </header>
  <section class="space-y-4">
    @foreach($questions as $question)
      <x-blocks.questions.card :question="$question"/>
    @endforeach
    <div class="p-4">
      {{ $questions->withQueryString()->links('components.pagination.tailwind') }}
    </div>
  </section>
</x-layouts.app>

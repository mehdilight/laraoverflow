@php
  /**
   * @var \App\Models\Filter\Filters $filters
   * @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Question[] $questions
   */
@endphp

<x-layouts.app>
  <x-slot:title>
    {{ sprintf('%s questions - Laraoverflow', $tag->name) }}
  </x-slot:title>
  <header class="space-y-4 py-10">
    <h1 class="text-2xl font-semibold">
      Questions tagged [{{ $tag->name }}]
    </h1>
    <p class="text-sm">
      {{ $tag->description }}
    </p>
    <div class="flex items-center justify-between">
      <div class="flex justify-between items-center">
        @php
          $sortFilter = $filters->findByName('sort');
        @endphp
        <div class="btn-group" role="group">
          <a href="{{ $filters->generateFilterLink('sort', 'most_votes') }}"
             class="btn-group-item {{ $sortFilter?->getValue() === 'most_votes' ? 'active' : '' }}">
            Most votes
          </a>
          <a href="{{ $filters->generateFilterLink('sort', 'newest') }}"
             class="btn-group-item {{ $sortFilter?->getValue() === 'newest' ? 'active' : '' }}">
            Newest
          </a>
          <a href="{{ $filters->generateFilterLink('sort', 'unanswered') }}"
             class="btn-group-item {{ $sortFilter?->getValue() === 'unanswered' ? 'active' : '' }}">
            Unanswered
          </a>
        </div>
      </div>
      <a class="btn btn-primary-outlined" href="{{ route('questions.create') }}">
        Ask Question
      </a>
    </div>
  </header>
  <section class="space-y-4">
    @foreach($questions as $question)
      <x-question.card :question="$question"/>
    @endforeach
    <div class="p-4">
      {{ $questions->withQueryString()->links('components.pagination.tailwind') }}
    </div>
  </section>
</x-layouts.app>

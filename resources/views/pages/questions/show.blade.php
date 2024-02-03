@php
  /**
  * @var \App\Models\Question $question
  */

@endphp

<x-layouts.app>
  <x-slot:title>
    {{ $question->title }}
  </x-slot:title>

  <header class="space-y-4 py-10">
    <div class="flex items-start justify-between">
      <div>
        <a href="{{ route('questions.show', [$question, $question->slug]) }}">
          <h1 class="text-2xl font-medium">
            {{ $question->title }}
          </h1>
        </a>
        <div class="text-xs space-x-2 mt-2">
          <span>
            <span class="text-black-600 font-medium">Asked</span>
            <span class="text-gray-500">{{ $question->created_at->diffForHumans() }}</span>
          </span>
          <span>
            <span class="text-black-600 font-medium">Modified</span>
            <span class="text-gray-500">{{ $question->updated_at->diffForHumans() }}</span>
          </span>
          <span>
            <span class="text-black-600 font-medium">Viewed</span> <span class="text-gray-500">30 times</span>
          </span>
        </div>
      </div>
      <a class="btn btn-primary-outlined" href="{{ route('questions.create') }}">
        Ask Question
      </a>
    </div>
  </header>

  <main class="text-sm py-4">
    <x-blocks.questions.post-viewer :model="$question" :user="$user" />

    @if($answers->isNotEmpty())
      <div>
        <header class="flex items-center justify-between mb-4">
          <h2 class="text-xl inline-block">
            Answers
          </h2>
          <form x-data x-ref="form" action="{{ route('questions.show', [$question, $question->slug]) }}">
            <label for="answers_filter" class="sr-only"></label>
            <select @change="$refs.form.submit()" id="answers_filter" name="filters[sort]" class="select">
              <option value="most_scores" @selected($filters->findByName('sort')?->getValue() === 'most_scores')>
                Highest score
              </option>
              <option value="newest" @selected($filters->findByName('sort')?->getValue() === 'newest')>
                Newsest
              </option>
            </select>
          </form>
        </header>
        <div class="grid gap-4">
          @foreach($answers as $answer)
            <x-blocks.questions.post-viewer :model="$answer" :question="$question" :user="$user" />
          @endforeach
        </div>
        <div class="p-4">
          {{ $answers->withQueryString()->links('components.pagination.tailwind') }}
        </div>
      </div>
    @else
      <div class="text-sm text-gray-500 py-4">
        Know someone who can answer? Share a link to this question via email, Twitter, or Facebook.
      </div>
    @endif
    @auth
      <form action="{{ route('questions.answers.store', [$question]) }}" method="post">
        @csrf
        <label for="answer_body" class="text-xl mb-4 inline-block">
          Your Answer
        </label>
        <x-trix-field value="{!! old('answer_body') !!}" id="answer_body" name="answer_body"
                      class="input bg-white mb-2"/>
        <button type="submit" class="btn btn-primary">
          Post your answer
        </button>
      </form>
    @endauth
  </main>
</x-layouts.app>

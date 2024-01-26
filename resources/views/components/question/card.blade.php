@php
  /**
   * @var \App\Models\Question $question
   */
@endphp

<section class="border-t border-solid border-gray-300 pl-8 py-4 pr-4 flex flex-start space-x-4">
  <div class="flex-shrink-0 flex flex-col text-xs text-black-500 text-right">
    <span>
      {{ $question->votes_score }} votes
    </span>
    <span>
      {{ $question->answers_count }} @if($question->answers_count === 1) answer @else answers @endif
    </span>
    <span>
      0 views
    </span>
  </div>
  <div class="flex-grow">
    <a class="text-blue-500 hover:text-blue-600 text mb-2 block font-medium"
       href="{{ route('questions.show', ['question' => $question->id, 'slug' =>$question->slug ]) }}">
      <h2>
        {{ $question->title }}
      </h2>
    </a>
    <div class="text-black-500 text-xs mb-2">
      <!-- TODO: render it in a good way. without html tags -->
      {{ \Illuminate\Support\Str::limit($question->body) }}
    </div>
    <div class="flex flex-wrap justify-between items-center gap-y-1">
      <div class="flex space-x-2">
        @foreach($question->tags as $tag)
          <x-tag.badge :tag="$tag"/>
        @endforeach
      </div>
      <div class="ml-auto">
        <a href="#" class="flex space-x-1 items-center">
          <span class="w-5 rounded-md h-5 text-xs bg-blue-200 text-blue-600 flex items-center justify-center">
            {{ \Illuminate\Support\Str::upper(substr($question->user->username, 0, 1)) }}
          </span>
          <span class="text-blue-500 text-xs hover:text-blue-600 focus:text-blue-600">
            {{ $question->user->username }}
          </span>
        </a>
      </div>
    </div>
  </div>
</section>

@php
  /**
   * @var \App\Models\Question $question
   */
@endphp

<section class="bg-white rounded-lg shadow py-4 px-6 flex flex-start space-x-4">
  <div class="flex-grow">
    <a class="text-violet-500 hover:text-violet-600 hover:text-violet-600 text mb-2 block font-medium text-lg"
       href="{{ route('questions.show', ['question' => $question->id, 'slug' =>$question->slug ]) }}">
      <h2>
        {{ $question->title }}
      </h2>
    </a>

    <div class="flex space-x-4">
      <div class="text-gray-700 text-sm mb-2 flex-grow">
        {{ $question->summary()}}
      </div>
      <div class="flex-shrink-0 flex flex-col text text-gray-700 text-right">
        <span class="flex space-x-1 items-center font-mono">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
               class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
          </svg>
          <span>
            {{ $question->votes_score }}
          </span>
        </span>
        <span class="flex space-x-1 items-center font-mono">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
               class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
          </svg>
          <span>
            {{ $question->answers_count }}
          </span>
        </span>
        <span class="flex space-x-1 items-center font-mono">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
               class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
          </svg>
          <span>
            0
          </span>
        </span>
      </div>
    </div>
    <div class="flex flex-wrap justify-between items-center gap-y-1">
      <div class="flex space-x-2">
        @foreach($question->tags as $tag)
          <x-tag.badge :tag="$tag"/>
        @endforeach
      </div>
      <div class="ml-auto flex items-center space-x-1">
        <a href="#" class="flex space-x-1 items-center">
          <span class="w-5 rounded-md h-5 text-xs bg-violet-200 text-violet-600 flex items-center justify-center">
            {{ \Illuminate\Support\Str::upper(substr($question->user->username, 0, 1)) }}
          </span>
          <span class="text-violet-500 text-xs hover:text-violet-600 focus:text-violet-600">
            {{ $question->user->username }}
          </span>
        </a>
        <span class="text-xs">
          Asked {{ $question->created_at->diffForHumans() }}
        </span>
      </div>
    </div>
  </div>
</section>

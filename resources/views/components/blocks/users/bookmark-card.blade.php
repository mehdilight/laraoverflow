@php
  /**
   * @var \App\Models\Bookmark $bookmark
   */

$destroyBookmarkRoute = is_null($bookmark->answer) ? route('questions.bookmark.destroy', [$bookmark->question, $bookmark->question->slug]) : route('questions.answers.bookmark.destroy', [$bookmark->question, $bookmark->answer]);
@endphp

<section class="text-sm bg-white p-4 shadow rounded-lg">
  <div class="flex space-x-4 mb-4">
    <div class="flex flex-col items-center space-y-4">
      @php
        $randomTooltipIdForVotesScore = \Symfony\Component\Uid\Ulid::generate();
      @endphp
      <div
        data-tooltip-target="{{ $randomTooltipIdForVotesScore }}"
        data-tooltip-placement="right"
        data-tooltip-style="light"
        aria-describedby="{{ $randomTooltipIdForVotesScore }}"
        class="text-gray-500 text-center text-xl cursor-pointer">
        {{ $bookmark->question->votes_score }}
      </div>
      <div
        id="{{ $randomTooltipIdForVotesScore }}"
        role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
        Votes Score
      </div>
      <div>
        <form
          action='{{ $destroyBookmarkRoute  }}'
          method="post"
        >
          @csrf
          @php
            $randomTooltipId = \Symfony\Component\Uid\Ulid::generate();
          @endphp
          @method('DELETE')
          <button
            data-tooltip-target="{{ $randomTooltipId }}"
            data-tooltip-placement="right"
            data-tooltip-style="light"
            aria-describedby="{{ $randomTooltipId }}"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                 class="w-6 h-6 text-violet-400">
              <path fill-rule="evenodd"
                    d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z"
                    clip-rule="evenodd"/>
            </svg>
          </button>
          <div
            id="{{ $randomTooltipId }}"
            role="tooltip"
            class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
            Unsave this question.
          </div>
        </form>
      </div>
    </div>
    <div class="flex-grow">
      <a
        class="text-violet-500 hover:text-violet-600 hover:text-violet-600 text mb-2 block font-medium text-lg"
        href="{{ route('questions.show', [$bookmark->question, $bookmark->question->slug]) }}">
        <h2>
          {{ $bookmark->question->title }}
        </h2>
      </a>
      <div class="flex flex-wrap items-center space-x-2 mt-4">
        @foreach($bookmark->question->tags as $tag)
          <x-tag.badge :tag="$tag"/>
        @endforeach
      </div>
      <div class="flex items-center justify-between mt-6">
        <div class="flex space-x-2 items-center">
          <a class="text-xs text-gray-500 hover:text-violet-600" href="#">Share</a>
        </div>
        <div>
          <a href="#" class="flex space-x-1 items-center">
            <span class="w-5 rounded-md h-5 text-xs bg-violet-200 text-violet-600 flex items-center justify-center">
              {{ \Illuminate\Support\Str::upper(substr($bookmark->question->user->username, 0, 1)) }}
            </span>
            <span class="text-violet-500 text-xs hover:text-violet-600 focus:text-violet-600">
              {{ $bookmark->question->user->username }}
            </span>
            <p class="text-xs">
              asked {{ $bookmark->question->created_at->diffForHumans() }}
            </p>
          </a>
        </div>
      </div>
    </div>
  </div>

  @if($bookmark->answer)
    <div class="px-4 py-2 rounded bg-violet-100 border-l-4 border-solid border-violet-400">
      <p class="text-violet-800 text-sm leading-5 tracking-normal">
        {{ $bookmark->answer->summary() }}
        <br>
        <a class="text-violet-900 inline-block mt-2"
           href="{{ route('questions.show', [$bookmark->question, $bookmark->question->slug]) }}">
          View answer
        </a>
      </p>
    </div>
  @endif
</section>

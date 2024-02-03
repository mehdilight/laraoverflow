@php
  use App\Models\Vote;
  use App\Models\Question;
  use App\Models\Answer;

  /**
   * @var Question|Answer $model
   * @var ?Question $question
   * @var ?\App\Models\User $user
   */

  $upvoteRoute = $model instanceof Question ? route('questions.upvote.store', [$model, $model->slug]) : route('questions.answers.upvote.store', [$question, $model]);
  $downvoteRoute = $model instanceof Question ? route('questions.downvote.store', [$model, $model->slug ]) : route('questions.answers.downvote.store', [$question, $model]);
  $storeCommentsRoute = $model instanceof Question ? route('questions.comments.store', [$model]) : route('questions.answers.comments.store', [$question, $model]);
  $bookmarkRoute = $model instanceof Question ? route('questions.bookmark.store', [$model, $model->slug]) : route('questions.answers.bookmark.store', [$question, $model]);
@endphp

<div class="flex space-x-4">
  <div class="flex flex-col items-center space-y-4">
    <div class="space-y-2">
      <form
        action="{{ $upvoteRoute }}"
        method="post"
      >
        @csrf
        <button
          class="flex items-center justify-center w-10 h-10 border border-solid border-violet-300 rounded-full focus:outline-none focus:ring focus:ring-violet-200 hover:outline-none hover:ring hover:ring-violet-200 @if($user && $user->upvoted($model)) hover:ring-0 hover:ring-transparent bg-violet-400 text-white border-violet-400 @endif"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd"
                  d="M9.47 6.47a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 1 1-1.06 1.06L10 8.06l-3.72 3.72a.75.75 0 0 1-1.06-1.06l4.25-4.25Z"
                  clip-rule="evenodd"/>
          </svg>
        </button>
      </form>
      <div class="text-gray-500 text-center text-xl">
        {{ $model->votes_score }}
      </div>
      <form action="{{ $downvoteRoute }}" method="post">
        @csrf
        <button
          class="flex items-center justify-center w-10 h-10 border border-solid border-violet-300 rounded-full focus:outline-none focus:ring focus:ring-violet-200 hover:outline-none hover:ring hover:ring-violet-200 @if($user && $user->downvoted($model)) hover:ring-0 hover:ring-transparent bg-violet-400 text-white border-violet-400 @endif">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd"
                  d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                  clip-rule="evenodd"/>
          </svg>
        </button>
      </form>
    </div>
    <div>
      <form
        action='{{ $bookmarkRoute  }}'
        method="post"
      >
        @csrf
        @php
          $randomTooltipId = \Symfony\Component\Uid\Ulid::generate();
        @endphp

        @if($user instanceof \App\Models\User && $user->bookmarked($model))
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
        @else
          <button
            data-tooltip-target="{{ $randomTooltipId }}"
            data-tooltip-placement="right"
            data-tooltip-style="light"
            aria-describedby="{{ $randomTooltipId }}"
          >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6 text-violet-800">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/>
            </svg>
          </button>
          <div
            id="{{ $randomTooltipId }}"
            role="tooltip"
            class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
            Save this question.
          </div>
        @endif
      </form>
    </div>
  </div>

  <div class="flex-grow">
    <div class="trix-content">
      {!! $model->body !!}
    </div>
    @if ($model instanceof \App\Models\Question)
      <div class="flex flex-wrap items-center space-x-2 mt-4">
        @foreach($model->tags as $tag)
          <x-tag.badge :tag="$tag"/>
        @endforeach
      </div>
    @endif
    <div class="flex items-center justify-between mt-6">
      <div class="flex space-x-2 items-center">
        <a class="text-xs text-gray-500 hover:text-violet-600" href="#">Share</a>
        <a class="text-xs text-gray-500 hover:text-violet-600" href="#">Edit</a>
      </div>
      <div>
        <a href="#" class="flex space-x-1 items-center">
          <span class="w-5 rounded-md h-5 text-xs bg-violet-200 text-violet-600 flex items-center justify-center">
            {{ \Illuminate\Support\Str::upper(substr($model->user->username, 0, 1)) }}
          </span>
          <span class="text-violet-500 text-xs hover:text-violet-600 focus:text-violet-600">
            {{ $model->user->username }}
          </span>
          <p class="text-xs">
            asked {{ $model->created_at->diffForHumans() }}
          </p>
        </a>
      </div>
    </div>
    <div class="mt-4 space-y-2">
      @foreach($model->comments as $comment)
        <x-blocks.questions.comment :comment="$comment"/>
      @endforeach
    </div>
    <div
      class="py-4"
      x-data="{
            isCommentBlockOpen: false,
            body: '',
            errorMessage: null,
            async handleCommentCreation() {
              let response = await this.$fetch('{{ $storeCommentsRoute }}', 'post', {
                body: this.body
              });

              if (response.statusCode === 422) {
                this.errorMessage =  response.json.message;

                return;
              }
             window.location.reload();
            }
          }"
    >
      <button
        class="text-gray-500 hover:text-blue-400 text-sm mb-4"
        @click="isCommentBlockOpen = true; setTimeout(()=> $refs.commentBlock.focus(), 100)"
      >
        Add a comment
      </button>
      <form
        @submit.prevent="handleCommentCreation"
        x-show="isCommentBlockOpen"
        class="flex items-start gap-2"
        style="display: none">
        @csrf
        <div class="flex-grow">
          <textarea
            x-ref="commentBlock"
            name="answer_comment_body"
            class="resize-none input"
            :class="{'input-has-error' : errorMessage}"
            x-model="body"
          ></textarea>
          <p
            x-show="errorMessage"
            x-text="errorMessage"
            class="text-red-500 text-xs mt-1">
          </p>
        </div>
        <button class="btn btn-primary text-sm">
          Add comment
        </button>
      </form>
    </div>
  </div>
</div>

@php
  /**
  * @var \App\Models\Question $question
  */

  use App\Models\Vote;
@endphp

<x-layouts.app>
  <x-slot:title>
    $question->title
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
            <span class="text-black-600 font-medium">Asked</span> <span
              class="text-gray-500">{{ $question->created_at->diffForHumans() }}</span>
          </span>
          <span>
            <span class="text-black-600 font-medium">Modified</span> <span
              class="text-gray-500">{{ $question->updated_at->diffForHumans() }}</span>
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
    <div class="flex space-x-4">
      <div class="space-y-2">
        <form action="{{ route('questions.upvote', [$question, $question->slug ]) }}" method="post">
          @csrf
          <button
            class="flex items-center justify-center w-10 h-10 border border-solid border-violet-300 rounded-full focus:outline-none focus:ring focus:ring-violet-200 hover:outline-none hover:ring hover:ring-violet-200 @if($question?->userVote?->value === Vote::UPVOTE_TYPE) hover:ring-0 hover:ring-transparent bg-violet-400 text-white border-violet-400 @endif"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd"
                    d="M9.47 6.47a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 1 1-1.06 1.06L10 8.06l-3.72 3.72a.75.75 0 0 1-1.06-1.06l4.25-4.25Z"
                    clip-rule="evenodd"/>
            </svg>
          </button>
        </form>
        <div class="text-gray-500 text-center text-xl">
          {{ $question->votes_score }}
        </div>
        <form action="{{ route('questions.downvote', [$question, $question->slug ]) }}" method="post">
          @csrf
          <button
            class="flex items-center justify-center w-10 h-10 border border-solid border-violet-300 rounded-full focus:outline-none focus:ring focus:ring-violet-200 hover:outline-none hover:ring hover:ring-violet-200 @if($question?->userVote?->value === Vote::DOWN_UPVOTE_TYPE) hover:ring-0 hover:ring-transparent bg-violet-400 text-white border-violet-400 @endif">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd"
                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd"/>
            </svg>
          </button>
        </form>
      </div>
      <div class="flex-grow">
        <div class="trix-content">
          {!! $question->body !!}
        </div>
        <div class="flex flex-wrap items-center space-x-2 mt-4">
          @foreach($question->tags as $tag)
            <x-tag.badge :tag="$tag"/>
          @endforeach
        </div>
        <div class="flex items-center justify-between mt-6">
          <div class="flex space-x-2 items-center">
            <a class="text-xs text-gray-500 hover:text-violet-600" href="#">Share</a>
            <a class="text-xs text-gray-500 hover:text-violet-600" href="#">Edit</a>
          </div>
          <div>
            <a href="#" class="flex space-x-1 items-center">
              <span class="w-5 rounded-md h-5 text-xs bg-violet-200 text-violet-600 flex items-center justify-center">
                {{ \Illuminate\Support\Str::upper(substr($question->user->username, 0, 1)) }}
              </span>
              <span class="text-violet-500 text-xs hover:text-violet-600 focus:text-violet-600">
                {{ $question->user->username }}
              </span>
              <p class="text-xs">
                asked {{ $question->created_at->diffForHumans() }}
              </p>
            </a>
          </div>
        </div>
        <div class="mt-4 space-y-2">
          @foreach($question->comments as $comment)
            <x-common.comment :comment="$comment"/>
          @endforeach
        </div>
        <div
          class="py-4"
          x-data="{
            isCommentBlockOpen: false,
            body: '',
            errorMessage: null,
            async handleCommentCreation() {
              let response = await this.$fetch('{{ route('questions.comments.store', [$question]) }}', 'post', {
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
    @if($question->answers->isNotEmpty())
      <div>
        <h2 class="text-xl mb-4 inline-block">
          Answers
        </h2>
        @foreach($question->answers as $answer)
          <div class="flex space-x-4">
            <div class="space-y-2">
              <form action="{{ route('questions.answers.upvote.store', [$question, $answer ]) }}"
                    method="post">
                @csrf
                <button
                  class="flex items-center justify-center w-10 h-10 border border-solid border-violet-300 rounded-full focus:outline-none focus:ring focus:ring-violet-200 hover:outline-none hover:ring hover:ring-violet-200 @if($answer?->userVote?->value === Vote::UPVOTE_TYPE) hover:ring-0 hover:ring-transparent bg-violet-400 text-white border-violet-400 @endif">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                          d="M9.47 6.47a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 1 1-1.06 1.06L10 8.06l-3.72 3.72a.75.75 0 0 1-1.06-1.06l4.25-4.25Z"
                          clip-rule="evenodd"/>
                  </svg>
                </button>
              </form>
              <div class="text-gray-500 text-center text-xl">
                {{ $answer->votes_score }}
              </div>
              <form action="{{ route('questions.answers.downvote.store', [$question, $answer ]) }}"
                    method="post">
                @csrf
                <button
                  class="flex items-center justify-center w-10 h-10 border border-solid border-violet-300 rounded-full focus:outline-none focus:ring focus:ring-violet-200 hover:outline-none hover:ring hover:ring-violet-200 @if($answer?->userVote?->value === Vote::DOWN_UPVOTE_TYPE) hover:ring-0 hover:ring-transparent bg-violet-400 text-white border-violet-400 @endif">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                          d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                          clip-rule="evenodd"/>
                  </svg>
                </button>
              </form>
            </div>
            <div>
              <div class="trix-content">
                {!! $answer->body !!}
              </div>
              <div class="flex items-center justify-between mt-6">
                <div class="flex space-x-2 items-center">
                  <a class="text-xs text-gray-500 hover:text-violet-600" href="#">Share</a>
                  <a class="text-xs text-gray-500 hover:text-violet-600" href="#">Edit</a>
                </div>
                <div>
                  <a href="#" class="flex space-x-1 items-center">
                    <span class="w-5 rounded-md h-5 text-xs bg-violet-200 text-violet-600 flex items-center justify-center">
                      {{ \Illuminate\Support\Str::upper(substr($answer->user->username, 0, 1)) }}
                    </span>
                    <span class="text-violet-500 text-xs hover:text-violet-600 focus:text-violet-600">
                      {{ $answer->user->username }}
                    </span>
                    <p class="text-xs">
                      answered {{ $answer->created_at->diffForHumans() }}
                    </p>
                  </a>
                </div>
              </div>
              <div class="mt-4 space-y-2">
                @foreach($answer->comments as $comment)
                  <x-common.comment :comment="$comment"/>
                @endforeach
              </div>
              <div
                class="py-4"
                x-data="{
                  isCommentBlockOpen: false,
                  body: '',
                  errorMessage: null,
                  async handleCommentCreation() {
                    let response = await this.$fetch('{{ route('questions.answers.comments.store', [$question, $answer]) }}', 'post', {
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
                  style="display: none" method="post"
                >
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
        @endforeach
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

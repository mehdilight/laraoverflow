<x-blocks.users.user-dashboard
  :user="$user"
  currentTab="activity"
>
  <main class="flex space-x-4">
    <section class="w-[250px] flex-shrink-0">
      <h2 class="text-lg font-semibold mb-2">
        Stats
      </h2>
      <section class="border px-4 py-3 rounded border-solid border-slate-300 grid grid-cols-2 gap-4">
        <div>
          <span class="text-md block font-semibold">
            {{ $user->reputation }}
          </span>
          <span class="text-sm text-slate-700">
            reputation
          </span>
        </div>
        <div>
          <span class="text-md block font-semibold">
            {{ $answersCount }}
          </span>
          <span class="text-sm text-slate-700">
            answers
          </span>
        </div>
        <div>
          <span class="text-md block font-semibold">
            {{ $questionsCount }}
          </span>
          <span class="text-sm text-slate-700">
            questions
          </span>
        </div>
      </section>
    </section>
    <section class="flex-grow">
      <section>
        <h2 class="text-lg font-semibold mb-2">
          Newest Questions
        </h2>
        <section class="border border-solid border-slate-300 rounded divide-y divide-slate-300 text-sm">
          @foreach($latestQuestions as $latestQuestion)
            <a class="block px-4 py-3 hover:text-violet-600" href="{{ route('questions.show', [$latestQuestion->id, $latestQuestion->slug]) }}">
              {{ $latestQuestion->title }}
            </a>
          @endforeach
        </section>
      </section>
      <section class="mt-4">
        <h2 class="text-lg font-semibold mb-2">
          Top Tags
        </h2>
        <section class="border border-solid border-slate-300 rounded divide-y divide-slate-300">
          @foreach($topTags as $topTag)
            <section class="flex justify-between items-center px-4 py-3">
              <x-tag.badge :tag="$topTag" />

              <span class="text-sm text-slate-700">
                {{ $topTag->questions_count }} Questions
              </span>
            </section>
          @endforeach
        </section>
      </section>
    </section>

  </main>
</x-blocks.users.user-dashboard>

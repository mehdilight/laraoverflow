<a
  class="text-sm bg-violet-100 focus:bg-violet-200 hover:bg-violet-200 text-violet-900 px-2 py-1 rounded"
  href="{{ route('questions.tagged.index', ['tag' => $tag->name]) }}"
>
  {{ $tag->name }}
</a>

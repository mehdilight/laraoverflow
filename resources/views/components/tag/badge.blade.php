<a
  class="text-xs bg-blue-200/60 hover:bg-blue-200 focus:bg-blue-200 text-blue-800 px-2 py-1 rounded"
  href="{{ route('questions.tagged.index', ['tag' => $tag->name]) }}"
>
  {{ $tag->name }}
</a>

@extends('layouts.app')

@section('title', 'Tags - Laraoverflow')

@section('content')
  <header class="space-y-4 px-4 py-4">
    <div>
      <h1 class="text-2xl font-semibold mb-4">
        Tags
      </h1>
      <p class="text-sm">
        A tag is a keyword or label that categorizes your question with other, similar questions. <br> Using the right
        tags makes it easier for others to find and answer your question.
      </p>
    </div>
  </header>

  <livewire:pages.tags.index />
@endsection

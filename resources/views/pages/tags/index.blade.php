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

  <section class="p-4">
    <form class="mb-4">
      <div class="relative">
        <label for="search" class="absolute top-0 bottom-0 left-0 flex items-center px-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
          </svg>
        </label>
        <input placeholder="Search" type="search" id="search"
               class="text-sm border-solid border-gray-300 rounded pl-8 focus:outline-none focus:ring focus:ring-orange-200 focus:border-gray-300">
      </div>
    </form>
    <div class="grid grid-cols-4 gap-2">
      @foreach($tags as $tag)
        <section class="p-4 rounded-lg shadow-lg bg-white">
          <x-tag.badge :tag="$tag"/>
          <p class="text-xs text-black-500 mt-4">
            {{ \Illuminate\Support\Str::limit($tag->description, 141) }}
          </p>
        </section>
      @endforeach
    </div>
  </section>
@endsection

@extends('layouts.app')

@section('title', 'Ask a public question - Laraoverflow')

@section('content')
  <section>
    <div class="flex flex-col items-center justify-center py-10 mx-auto">
      <div class="w-full bg-white">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
          Ask a public question
        </h1>
        <form class="space-y-4 md:space-y-6" action="{{ route('questions.store') }}" method="post">
          @csrf
          <div>
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
              Title
            </label>
            <input
              type="text"
              name="title"
              id="title"
              class="input @error('title') input-has-error @enderror"
              value="{{ old('title') }}"
            >
            @error('title')
            <p class="text-red-500 text-xs mt-1">
              {{ $message }}
            </p>
            @enderror
          </div>
          <div>
            <label for="body" class="block mb-2 text-sm font-medium text-gray-900">
              Body
            </label>
            <x-trix-field value="{!! old('body') !!}" id="body" name="body"
                          class="input {{ $errors->first('body') ? 'input-has-error' : '' }}"/>
            @error('body')
            <p class="text-red-500 text-xs mt-1">
              {{ $message }}
            </p>
            @enderror
          </div>
          <div>
            <label for="tags" class="block mb-2 text-sm font-medium text-gray-900">
              tags
            </label>
            <x-tags-select/>
            @error('tags')
            <p class="text-red-500 text-xs mt-1">
              {{ $message }}
            </p>
            @enderror
          </div>
          <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">
              Post my question
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection

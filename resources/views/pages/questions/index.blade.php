@extends('layouts.app')

@section('title', 'Frequent questions - Laraoverflow')

@section('content')
  <header class="space-y-4 px-4 py-4">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">
        All Questions
      </h1>
      <a class="btn btn-secondary" href="{{ route('questions.create') }}">
        Ask Question
      </a>
    </div>
    <div class="flex justify-between items-center">
      <p class="text-sm">
        24,048,072 questions
      </p>
      <div class="inline-flex rounded" role="group">
        <a href="#"
           class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700">
          Newest
        </a>
        <a href="#"
           class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700">
          Most votes
        </a>
        <a href="#"
           class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700">
          Unanswered
        </a>
      </div>
    </div>
  </header>
  <section>
    @foreach($questions as $question)
      <x-question.card :question="$question"/>
    @endforeach
  </section>
@endsection

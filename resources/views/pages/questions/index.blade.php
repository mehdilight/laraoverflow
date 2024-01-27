@php
/**
 * @var \App\Models\Filter\Filters $filters
 */
@endphp
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
        {{ $questions->total() }} {{ $questions->total() == 1 ? 'question' : 'questions' }}
      </p>
      @php
        $sortFilter = $filters->findByName('sort');
      @endphp
      <div class="inline-flex rounded" role="group">
        <a href="?filters[sort]=most_votes"
           class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 {{ $sortFilter?->getValue() === 'most_votes' ? '!bg-orange-200 !text-orange-600' : '' }}">
          Most votes
        </a>
        <a href="?filters[sort]=newest"
           class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 {{ $sortFilter?->getValue() === 'newest' ? '!bg-orange-200 !text-orange-600' : '' }}">
          Newest
        </a>
        <a href="?filters[sort]=unanswered"
           class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e hover:bg-gray-100 hover:text-orange-700 focus:z-10 focus:ring-2 focus:ring-orange-700 focus:text-orange-700 {{ $sortFilter?->getValue() === 'unanswered' ? '!bg-orange-200 !text-orange-600' : '' }}">
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

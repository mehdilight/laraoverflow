<section class="border-t border-solid border-gray-300 p-4 flex flex-start space-x-4">
  <div class="flex-shrink-0 flex flex-col text-xs text-black-500 text-right">
    <span>
      0 votes
    </span>
    <span>
      0 answers
    </span>
    <span>
      0 views
    </span>
  </div>
  <div class="flex-grow">
    <a class="text-blue-500 hover:text-blue-600 text-sm mb-2 block font-medium" href="#">
      <h2>
        Jetty 12 gives a 301 when there is no trailing slash for a post request
      </h2>
    </a>
    <p class="text-black-500 text-xs mb-2">
      A request without a trailing slash will now give a 301 where as previously we would get a 302 response. This
      seems to be a change of behaviour between Jetty 11 and Jetty 12 $ httpie --verbose --all ...
    </p>
    <div class="flex flex-wrap justify-between items-center gap-y-1">
      <div class="flex space-x-2">
        <a class="text-xs bg-blue-200 text-blue-800 px-2 py-1 rounded"
           href="{{ route('questions.tagged.index', ['tag' => 'zee']) }}">
          laravel
        </a>
        <a class="text-xs bg-blue-200 text-blue-800 px-2 py-1 rounded"
           href="{{ route('questions.tagged.index', ['tag' => 'zee']) }}">
          ruby
        </a>
      </div>
      <div class="ml-auto">
        <a href="#" class="flex space-x-1 items-center">
          <span class="w-5 rounded-md h-5 text-xs bg-blue-200 text-blue-600 flex items-center justify-center">
            E
          </span>
          <span class="text-blue-500 text-xs hover:text-blue-600 focus:text-blue-600">
            Edward Barker
          </span>
        </a>
      </div>
    </div>
  </div>
</section>

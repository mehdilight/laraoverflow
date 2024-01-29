<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  @vite('resources/css/app.css')
  <x-rich-text-trix-styles/>
  @stack('header_scripts')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script>
    document.addEventListener('alpine:init', async () => {
      class AlpineResponse {
        constructor(statusCode, json) {
          this.statusCode = statusCode;
          this.json = json;
        }
      }
      Alpine.magic('fetch', () => {
        return async (url, method = 'GET', body) => {
          let response = await fetch(url, {
            method: method,
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(body)
          });

          return new AlpineResponse(response.status, await response.json());
        }
      })
    })
  </script>
</head>

<body class="antialiased text-gray-950 bg-gray-50">
@include('layouts.header')
<div class="main-container mx-auto flex space-x-10">
  @include('layouts.sidebar')
  <div class="flex-grow">
    @yield('content')
  </div>
</div>
@vite(['resources/js/app.js'])

@stack('scripts')
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> @yield('title')</title>
  @vite('resources/css/app.css')
</head>

<body class="antialiased text-gray-950">
@include('layouts.header')
<div class="main-container mx-auto flex">
  @include('layouts.sidebar')
  <div class="flex-grow">
    @yield('content')
  </div>
</div>
@vite(['resources/js/app.js'])
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Home' }}</title>
    @include('layouts.partials._head')
</head>

<body id="kt_body" class="d-flex justify-content-center">
  <div class="body-container">
    @include('layouts.partials._header')

    <div class="container mt-4 px-4">
      @yield('content')
    </div>
  </div>
  @include('layouts.partials._foot')
</body>

</html>
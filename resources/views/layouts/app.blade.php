<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/hoofpedia_logo.png') }}">
    <title>{{ $title ?? 'Home' }}</title>
    @include('layouts.partials._head')
    @livewireStyles
    <style>
      .floating{
        position: fixed;
        bottom: 0;
        background: #969696;
        border-radius: 4px 4px 0 0;
      }
      #searchWrapper{
        max-height: 70vh;
        overflow-y: scroll;
      }
    </style>
</head>

<body id="kt_body" class="d-flex justify-content-center">
  <div class="body-container">
    @include('layouts.partials._header')
    @include('search')
    <div class="container mt-4 px-4 pb-4">
      @yield('content')
    </div>
  </div>
  <div class="floating p-2">
    <a href="{{ url()->previous() }}" data-bs-toggle="tooltip" title="Back" class="btn btn-sm btn-warning me-2"> <i class="fa-solid fa-arrow-left"></i></a>
    <a href="{{ route('home') }}" data-bs-toggle="tooltip" title="Home" class="btn btn-sm btn-warning"> <i class="fa-solid fa-house"></i></a>
  </div>
  @include('layouts.partials._foot')
  @livewireScripts
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '1046921429798190',
        cookie     : true,
        xfbml      : true,
        version    : '{api-version}'
      });
        
      FB.AppEvents.logPageView();   
        
    };
  
    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>
  @stack('scripts')
</body>

</html>
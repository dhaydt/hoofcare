<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand text-capitalize" href="#">{{ env('APP_NAME') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto w-100 mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ $active == 'home' ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        @foreach ($category as $c)
        <li class="nav-item">
          <a class="nav-link" href="javascript:">{{ $c['name'] }}</a>
        </li>
        @endforeach
        @if (auth()->user())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>{{ auth()->user()->name }}</span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a></li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <li><button class="dropdown-item" type="submit">Logout</button></li>
            </form>
          </ul>
        </li>
        @else
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary ms-auto"><p class="my-1">Sign In</p></a>
        @endif
      </ul>
      {{-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> --}}
    </div>
  </div>
</nav>
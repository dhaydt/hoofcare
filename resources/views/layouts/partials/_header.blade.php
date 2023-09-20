<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand text-capitalize" href="#">{{ env('APP_NAME') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ $active == 'home' ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        @foreach ($category as $c)
        <li class="nav-item">
          <a class="nav-link" href="javascript:">{{ $c['name'] }}</a>
        </li>
        @endforeach
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if (auth()->user())
              <span>{{ auth()->user()->name }}</span>
            @else
              <span>Login</span>
            @endif
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @if (auth()->user())
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <li><button class="dropdown-item" type="submit">Logout</button></li>
            </form>
            @else
            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
            @endif
          </ul>
        </li>
      </ul>
      {{-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> --}}
    </div>
  </div>
</nav>
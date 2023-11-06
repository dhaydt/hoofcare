<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand text-capitalize d-block d-md-none" href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-column-reverse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto w-100 mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ $active == 'home' ? 'active' : '' }}" aria-current="page"
            href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach ($category as $c)
            <li class="dropdown-item">
              <a class="nav-link  {{ $active == $c['id'] ? 'active' : '' }}"
                href="{{ route('home_menu', [$c['id'], $c['name']]) }}">{{ $c['name'] }}</a>
            </li>
            @endforeach
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $active == 'contact' ? 'active' : '' }}"
            href="{{ route('contact') }}">Hoofpedia Contacts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"
            href="javascript:">Podcasts (Coming Soon)</a>
        </li>
        <div class="nav-item ms-auto mt-1">
          <button class="nav-link btn" data-bs-toggle="modal" data-bs-target="#searchModal">
              Search <i class="fa-solid fa-search"></i>
          </button>
        </div>
        {{-- @foreach ($category as $c)
        <li class="nav-item">
          <a class="nav-link  {{ $active == $c['id'] ? 'active' : '' }}"
            href="{{ route('home_menu', [$c['id'], $c['name']]) }}">{{ $c['name'] }}</a>
        </li>
        @endforeach --}}


      </ul>
      <ul class="navbar-nav ms-auto w-100 mb-2 mb-lg-0">
        <a class="navbar-brand text-capitalize d-none d-md-block" href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
        <li class="nav-item ms-auto">
          <a class="nav-link {{ $active == 'privacy' ? 'active' : '' }}" aria-current="page"
            href="{{ route('privacy') }}">Privacy Policy</a>
        </li>
        @if (auth()->user())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
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
        <li class="nav-item">
          <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary ms-auto">
            <p class="my-1">Sign In</p>
          </a>
        </li>
        @endif
      </ul>
      {{-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> --}}
    </div>
  </div>
</nav>
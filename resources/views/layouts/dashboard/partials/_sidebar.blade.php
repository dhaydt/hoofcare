<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
  <div class="logo d-flex justify-content-between">
    <a href="{{ route('home') }}">
      {{-- <img src="{{ asset('asset_dashboard/img/logo.png') }}" alt="HOOFCARE"> --}}
      <h3>HOOFCARE</h3>
    </a>
    <div class="sidebar_close_icon d-lg-none">
      <i class="ti-close"></i>
    </div>
  </div>
  <ul id="sidebar_menu">
    <li class=>
      <a href="{{ route('user.dashboard') }}" aria-expanded="false" class="{{ $active == 'dashboard' ? 'active' : '' }}">
        <div class="icon_menu">
          <img src="{{ asset('asset_dashboard/img/menu-icon/dashboard.svg') }}" alt="dashboard">
        </div>
        <span>Dashboard</span>
      </a>
    </li>
    <li class=>
      <a href="{{ route('user.dashboard.library') }}" aria-expanded="false" class="{{ $active == 'library' ? 'active' : '' }}">
        <div class="icon_menu">
          <img src="{{ asset('asset_dashboard/img/menu-icon/8.svg') }}" alt="library">
        </div>
        <span>Library</span>
      </a>
    </li>
  </ul>
</nav>
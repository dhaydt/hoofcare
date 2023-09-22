<div class="col-md-3">
  <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 100%;">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="javascript:" class="nav-link {{ $sideOn == 'library' ? 'active' : '' }}" aria-current="page">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#home"></use>
          </svg>
          Library
        </a>
      </li>
      @foreach ($menu as $m)
      <li>
        <a href="javascript:" class="nav-link link-dark">
          <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#speedometer2"></use>
          </svg>
          {{ $m['name'] }}
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</div>
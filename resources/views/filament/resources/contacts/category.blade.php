<div class="service-contact">
  @foreach (json_decode($getState()) as $c)
  <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
    {{ $c }}
  </span>
  @endforeach
</div>
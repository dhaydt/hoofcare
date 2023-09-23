@extends('layouts.app')
<style>
  .title-item a{
    text-decoration: none;
    color: #000;
  }
</style>
@section('content')
    <section class="section mb-3 card shadow-sm">
      <div class="section-header card-header">
        <h5 class="card-title">{{ $title }}</h5>
      </div>
      <div class="card-body row px-4">
        @foreach ($data as $i)
        <div class="card p-2 flex-row item d-flex mb-2">
          <div class="avatar d-flex align-items-center">
            <img src="{{ asset('storage/'.$i['pic1']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'" height="60px" width="60px" alt="">
          </div>
          <div class="ms-3 w-100 p-2">
            <div class="title-item">
              <a href="{{ route('item.detail', [$i['id'], $i['name']]) }}"><h5>{{ $i['name'] }}</h5></a>
              <span class="description">{{ $i['description'] }}</span>
            </div>
          </div>
        </div>
        @endforeach
      </div>
  </section>

@endsection
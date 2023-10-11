@extends('layouts.app')
<style>
  .title-item a {
    text-decoration: none;
    color: #000;
  }
  .item-title{
    background-color: #000;
    border-radius: 50%;
    border: 8px solid grey;
    color: #fff;
    width: 85px;
    font-size: 10px;
    display: flex;
    font-weight: 700;
    justify-content: center;
    text-transform: uppercase;
    text-align: center;
    align-items: center;
    height: 85px;
  }
  .desc-item{
    font-weight: 600;
    text-transform: capitalize;
  }
</style>
@section('content')
@if (count($iklan) > 0)
<div class="iklan-section mb-3">
  @foreach ($iklan as $i)
  <div class="wrapper mb-1">
    <img src="{{ asset('storage/'.$i['image']) }}" height="100px" width="100%" alt="ad">
  </div>
  @endforeach
</div>
@endif

<div class="row mb-3">
  @foreach ($counter as $c)
  <a href="{{ route('home_menu', [$c['id'], $c['name']]) }}" class="item-category d-flex col-md-4 mb-2">
    <div class="item-title">
      {{ $c['name'] }}
    </div>
    <div class="item-description ms-2 d-flex align-items-start flex-column justify-content-center">
      <div class="desc-item"><i class="fa-regular fa-lightbulb mr-2"></i>  {{ count($c['items']) }} Topics</div>
      <div class="desc-item"><i class="fa-regular fa-comments"></i> {{ $c['counter'] }} Conversation</div>
    </div>
  </a>
  @endforeach
</div>

@foreach ($data as $d)
<section class="section mb-3 card shadow-sm">
  <div class="section-header card-header">
    <h5 class="card-title">{{ $d['name'] }}</h5>
  </div>
  <div class="card-body row px-4">
    @foreach ($d['list']->take(4) as $i)
    <div class="card p-2 flex-row item d-flex mb-2">
      <div class="avatar d-flex align-items-center">
        <img src="{{ asset('storage/'.$i['pic1']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'"
          height="60px" width="60px" alt="">
      </div>
      <div class="ms-3 w-100 p-2">
        <div class="title-item">
          <a href="{{ route('item.detail', [$i['id'], $i['name']]) }}">
            <h5>{{ $i['name'] }}</h5>
          </a>
          <span class="description">{{ $i['description'] }}</span>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>
@endforeach

@endsection
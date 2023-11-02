@extends('layouts.app')
<style>
  .wrapper img{
    height: 100px;
  }

  .text-gray {
    color: #000;
    text-decoration: none;
    font-size: 1.5rem;
  }

  .row .imgRef {
    max-width: 80%;
    width: auto;
    max-height: 400px;
  }

  .row h5 {
    color: #606060;
  }

</style>
@section('content')
<div class="container">
  @if (count($iklan) > 0)
  <div class="iklan-section mb-3">
    @foreach ($iklan as $i)
    <a href="{{ $i['link'] }}" target="_blank" class="wrapper mb-1">
      <img src="{{ asset('storage/'.$i['image']) }}" height="100px" width="100%" alt="ad">
    </a>
    @endforeach
  </div>
  @endif
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <h4>
          <b>{{ $data['name'] }}</b>
        </h4>
        @include('layouts.partials._navigation')
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <h5>Online Links</h5>
        <a href="{{ $data['online_link'] }}" class="text-gray">{{ $data['online_link'] ?? env('APP_URL').'/'.$data['id'].'/'.$data['name'] }}</a>
      </div>
      <hr>
      @if ($data['pic1'])
      <div class="row">
        <h5>Reference Image 0</h5>
        <img src="{{ asset('storage/'.$data['pic1']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'"
          class="imgRef mx-auto" alt="">
      </div>
      <hr>
      @endif
      @if ($data['pic2'])
      <div class="row">
        <h5>Reference Image 1</h5>
        <img src="{{ asset('storage/'.$data['pic2']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'"
          class="imgRef mx-auto" alt="">
      </div>
      <hr>
      @endif
      @if ($data['pic3'])
      <div class="row">
        <h5>Reference Image 2</h5>
        <img src="{{ asset('storage/'.$data['pic3']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'"
          class="imgRef mx-auto" alt="">
      </div>
      <hr>
      @endif
      @if ($data['pic4'])
      <div class="row">
        <h5>Reference Image 3</h5>
        <img src="{{ asset('storage/'.$data['pic4']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'"
          class="imgRef mx-auto" alt="">
      </div>
      <hr>
      @endif
      @if ($data['pic5'])
      <div class="row">
        <h5>Reference Image 4</h5>
        <img src="{{ asset('storage/'.$data['pic5']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'"
          class="imgRef mx-auto" alt="">
      </div>
      <hr>
      @endif
      @if ($data['file1'])
      <div class="row mb-4">
        <h5 class="my-3">File Link 1</h5>
        <div class="container d-flex justify-content-center">
          <a href="{{ route('flipped', [$data['file1']['id'], $data['file1']['name']]) }}" target="_blank"
            class="btn btn-warning btn-sm mb-3">
            Show Flipped file
          </a>
        </div>
        <iframe src="{{ asset('storage/'.$data['file1']['file']) }}" frameborder="0" height="600" width="400"></iframe>
      </div>
      <hr>
      @endif
      @if ($data['file2'])
      <div class="row mb-4">
        <h5 class="my-3">File Link 2</h5>
        <div class="container d-flex justify-content-center">
          <a href="{{ route('flipped', [$data['file2']['id'], $data['file2']['name']]) }}" target="_blank"
            class="btn btn-warning btn-sm mb-3">
            Show Flipped file
          </a>
        </div>
        <iframe src="{{ asset('storage/'.$data['file2']['file']) }}" frameborder="0" height="600" width="400"></iframe>
      </div>
      <hr>
      @endif
      <livewire:comments :model="$data" />
    </div>
  </div>
</div>
@endsection
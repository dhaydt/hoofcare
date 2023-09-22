@extends('layouts.app')
<style>
  .text-gray{
    color: #000;
    text-decoration: none;
    font-size: 1.5rem;
  }
  .row .imgRef{
    max-width: 80%;
    width: auto;
    max-height: 400px;
  }
  .row h5{
    color: #606060;
  }
</style>
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <h4>
          <b>{{ $data['name'] }}</b>
        </h4>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <h5>Online Links</h5>
        <a href="{{ $data['online_link'] }}" class="text-gray">{{ $data['online_link'] }}</a>
      </div>
      <hr>
      <div class="row">
        <h5>Reference Image 0</h5>
        <img src="{{ asset('storage/'.$data['pic1']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'" class="imgRef mx-auto" alt="">
      </div>
      <hr>
      <div class="row">
        <h5>Reference Image 1</h5>
        <img src="{{ asset('storage/'.$data['pic2']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'" class="imgRef mx-auto" alt="">
      </div>
      <hr>
      <div class="row">
        <h5>Reference Image 2</h5>
        <img src="{{ asset('storage/'.$data['pic3']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'" class="imgRef mx-auto" alt="">
      </div>
      <hr>
      <div class="row">
        <h5>Reference Image 3</h5>
        <img src="{{ asset('storage/'.$data['pic4']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'" class="imgRef mx-auto" alt="">
      </div>
      <hr>
      <div class="row">
        <h5>Reference Image 4</h5>
        <img src="{{ asset('storage/'.$data['pic5']) }}" onerror="this.src='{{ asset('assets/images/no_img.jpeg') }}'" class="imgRef mx-auto" alt="">
      </div>
      <hr>
      <div class="row">
        <h5>File Link 1</h5>
        <iframe src="{{ asset('storage/'.$data['file_link1']) }}" frameborder="0" height="600" width="400"></iframe>
      </div>
      <hr>
      <div class="row">
        <h5>File Link 2</h5>
        <iframe src="{{ asset('storage/'.$data['file_link2']) }}" frameborder="0" height="600" width="400"></iframe>
      </div>
      <hr>

    </div>
  </div>
</div>
@endsection
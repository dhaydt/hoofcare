@extends('layouts.app')

@section('content')
<style>
  .magazine-viewport{
    max-width: 100%;
  }
</style>
<div class="container">
  <div class="row">
    <div class="container mb-4">
      <h2 class="text-center mb-3">
        {{ $data['name'] }}
      </h2>
      @if ($data['count'] > 0)
      @php
      $file1_img = [];
      if($data['count'] > 1){
      for($i=1; $i <= $data['count']; $i++){ $item=[ 'folder'=> $data['name'],
        'img' => $data['name']. '-'.$i - 1 .'.jpg',
        ];
        array_push($file1_img, $item);
        }
        }else{
        $item = [
        'folder' => $data['name'],
        'img' => $data['name'].'.jpg',
        ];
        array_push($file1_img, $item);
        }
        @endphp
        <div id="mybook">
            @foreach ($file1_img as $f1)
              <div>
                <img src="{{ asset('storage/flip/'.$f1['folder'].'/'.$f1['img']) }}" width="100%" height="auto"
                  class="page-1">
              </div>
              @endforeach
        </div>
        @endif
        </div>
    </div>
    </div>
    @endsection
@push('scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script> window.jQuery || document.write('<script src="{{ asset("assets/>js/booklet/jquery-2.1.0.min.js") }}"><\/script>') </script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="{{ asset('assets/js/booklet/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/js/booklet/jquery.booklet.latest.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#mybook').booklet({
                shadows: false,
                closed: true,
                width:  '100%',
                height: 600
            });
        })
    </script>
@endpush
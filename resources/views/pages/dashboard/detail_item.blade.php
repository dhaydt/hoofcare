@extends('layouts.dashboard.app')
@section('content')
@include('pages.dashboard.partials._subHeader')

@if ($errors->any())
<div class="alert alert-danger">
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

@livewire('dashboard.detailItem', ['id' => $data['id'] ?? 0])
@endsection
@extends('layouts.dashboard.app')
@section('content')
  @include('pages.dashboard.partials._subHeader')
  @livewire('dashboard.detailItem', ['id' => $data['id']])
@endsection
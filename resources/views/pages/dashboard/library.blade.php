@extends('layouts.dashboard.app')
@section('content')
  @include('pages.dashboard.partials._subHeader')
  @livewire('dashboard.library')
@endsection
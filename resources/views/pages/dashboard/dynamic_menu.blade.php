@extends('layouts.dashboard.app')
@section('content')
  @include('pages.dashboard.partials._subHeader')
  @livewire('dashboard.menu', ['cat_id' => $cat_id])
@endsection
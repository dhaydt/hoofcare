@extends('layouts.app')

@section('content')
<section class="profile">
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        Edit Profile
      </div>
    </div>
    <div class="card-body">
      @if(session('error'))
      <div class="alert alert-danger">
          <b>Opps!</b> {{session('error')}}
      </div>
      @endif
      @if(session('success'))
      <div class="alert alert-success">
          <b>Yeay!</b> {{session('success')}}
      </div>
      @endif
      <form method="POST" action="{{ route('user.update.profile') }}">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail3" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" id="exampleInputEmail3" value="{{ auth()->user()->name }}" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ auth()->user()->email }}" disabled>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
          <input type="password" name="c_password" class="form-control" id="exampleInputPassword2">
        </div>
        <button type="submit" class="btn btn-primary ms-auto">Update</button>
      </form>
    </div>
  </div>
</section>
@endsection
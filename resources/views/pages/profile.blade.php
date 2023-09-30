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
      <div class="row">
        <fieldset class="bg-gray">
          <legend>Connect to Facebook</legend>
          <div class="row mb-3">
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{ auth()->user()->fb_token ?? '' }}" readonly>
            </div>
            <div class="col-sm-2">
              <a href="{{ route('facebook') }}" class="btn btn-info px-4 text-light" title="click">
                <i class="fa-solid fa-key"></i>
              </a>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-10">
              <input type="text" class="form-control facebook_page_id" name="facebook_page_id" placeholder="Facebook page ID" value="{{ auth()->user()->page_id ?? '' }}" required>
            </div>
            <div class="col-sm-2">
              <a href="javascript:void(0)" class="btn btn-info px-4 store_page_id text-light" title="click"><i class="fas fa-upload"></i></a>
            </div>
          </div>
        </fieldset>
      </div>
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
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Occupation</label>
          <input type="text" name="occupation" class="form-control" value="{{ auth()->user()->occupation }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Address</label>
          <textarea name="address" class="form-control">{{ auth()->user()->address }}</textarea>
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
@push('scripts')
  <script>
    $(document).ready(function(){
      $('body').on('click', '.store_page_id', function(e){
        var data = $('.facebook_page_id').val();

        $.ajax({
          url: '{{ route("facebook_page_id") }}',
          data: {
            facebook_page_id: data
          },
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          success: function(data){
            if(data.status == 200){
              Swal.fire({
                title: 'Success!',
                text: data.msg,
                icon: 'success',
                confirmButtonText: 'OK'
              })

            }else{
              Swal.fire({
                title: 'Error!',
                text: data.msg,
                icon: 'error',
                confirmButtonText: 'Cancel'
              })

            }
          }
        })
      })
    })
  </script>
@endpush
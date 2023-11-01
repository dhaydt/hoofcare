<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login - Hoofpedia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    .body-container {
      max-width: 800px;
      min-width: 800px;
    }

  </style>
</head>

<body>
  <div class="container body-container text-center"><br>
    <div class="col-md-8 row justify-content-center mx-auto text-start mt-4">
      <h2 class="text-center"><b>SIGN UP HOOFPEDIA</b></h3>
        <div class="logo d-flex mb-3">
          <img src="{{ asset('assets/images/hoofpedia.jpg') }}" class="mx-auto" height="100px" alt="">
        </div>
        <hr>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <form action="{{ route('actionRegister') }}" method="post">
          @csrf
          <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" required>
          </div>
          <div class="form-group mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="form-group mb-2">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="Phone number" required>
          </div>
          <div class="form-group mb-2">
            <label>Occupation</label>
            <input type="text" name="occupation" class="form-control" placeholder="Occupation">
          </div>
          <div class="form-group mb-2">
            <label>Address</label>
            <textarea name="address" class="form-control" cols="12" rows="3"></textarea>
          </div>
          <div class="form-group mb-2">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>
          <div class="form-group mb-2">
            <label>Password Confirmation</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
          </div>
          <div class="row mt-3">
            <div class="btn-login d-flex justify-content-evenly mb-2">
              <button type="submit" class="btn btn-sm btn-primary btn-block col-4 me-2">Sign Up</button>
            </div>
            <hr>
            <p class="text-center">Already have an account? <a href="{{ route('login') }}">Sign In</a> now!</p>
            <p class="text-center">Back to <a href="{{ route('home') }}">Home</a></p>
          </div>
        </form>
    </div>
  </div>
</body>

</html>
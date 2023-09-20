<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Hoofcare</title>
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
            <h2 class="text-center"><b>HOOFCARE</b><br>Storage Application</h3>
                <hr>
                @if(session('error'))
                <div class="alert alert-danger">
                    <b>Opps!</b> {{session('error')}}
                </div>
                @endif
                <form action="{{ route('actionlogin') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                    </div>
                    <div class="form-group mt-4">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <div class="row mt-3">
                        <div class="btn-login d-flex justify-content-evenly mb-2">
                            <button type="submit" class="btn btn-primary btn-block col-5">Sign In</button>
                            <a class="btn btn-outline-secondary col-5" href="{{ '/auth/redirect'}}">
                                <img src="{{ asset('assets/images/google.png') }}" height="20px" alt="google-signin">
                                Sign In With Google
                            </a>
                        </div>
                        <hr>
                        <p class="text-center">Dont have an account? <a href="#">Sign Up</a> now!</p>
                    </div>
                </form>
        </div>
    </div>
</body>

</html>